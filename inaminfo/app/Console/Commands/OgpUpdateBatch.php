<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Libs\ogpLoader;
use App\Libs\awsS3Uploader;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;

class OgpUpdateBatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch:ogpupdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * The file path in inaminfo server for image cache.
     */

    protected $tmp_file_path = '/tmp/';
    protected $log_name = 'OGP Update Batch : ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Log::info($this->log_name.'Start OGP update batch.');

        $s3uploader = new awsS3Uploader();

        $eventUrls = $this->loadEventUrls();
        if(!$eventUrls) exit();

        $update_count = 0;
        foreach($eventUrls as $url){
            $event_url_id = $url->event_url_id;
            $ogpLoader = new ogpLoader($url->url);
            // OGP取得
            $ogp = $ogpLoader->getOGP();
            if(!isset($ogp['image'])){
                // OGPが未設定の場合
                \Log::alert($this->log_name.'Get ogp image failed. event_url_id = '.$event_url_id);
                $this->updateEventUrlNothingOGP($event_url_id,$ogp);
                $update_count++;
            }else{
                // ローカルサーバのストレージに画像を一時保存する.
                $tmp_img_path = $this->saveTmpImage($ogp['image']);
                // 正常に保存できた場合はS3へアップロードする.
                if($tmp_img_path){
                    try{
                        $s3_path = $s3uploader->uploadImage($tmp_img_path);
                    }catch (Exception $e){
                        \Log::error($this->log_name.'Upload image file error. '.$e);
                        continue;
                    }
                }
        
                // event_urlデータを取得したOGPおよびS3のファイル名で更新する.
                $this->updateEventUrl($event_url_id,$ogp,$s3_path);
                $update_count++;
            }
        }

        // tmpファイルを削除
        \File::cleanDirectory(storage_path().$this->tmp_file_path);
        \Log::info($this->log_name.'Delete local tmp image file.');
        $max = count($eventUrls);
        \Log::info($this->log_name.'Finish OGP update batch. updateData '."$update_count / $max");
    }

    private function saveTmpImage($image_url){
        $tmp_file_name = 'tmp_'.date('YmdHis');
        $file_path = storage_path().$this->tmp_file_path.$tmp_file_name;
        try{
            $image = Image::make($image_url);
            $image->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
              });
            $image->save($file_path);
        }catch (Exception $e){
            \Log::error($this->log_name.'Save temp image file error. '.$e);
            return false;
        }
        return (file_exists($file_path)) ? $file_path : false;
    }

    private function loadEventUrls(){
        try{
            return DB::table("event_url")
            ->whereNull('og_cache_create_date')
            ->orwhere('og_cache_create_date','<',date('Y-m-d', strtotime('-2 week', time())))
            ->get();
        }catch (Exception $e){
            \Log::error($this->log_name.'Database Error. '.$e);
            return false;
        }
    }

    private function updateEventUrl($event_url_id,$ogp,$s3url){
        try{
            $res = DB::table('event_url')
            ->where('event_url_id',$event_url_id)
            ->update(['og_title' => $ogp['title'],
                      'og_description' => $ogp['description'],
                      'og_sitename' => $ogp['site_name'],
                      'og_img_cache_url' => $s3url,
                      'og_cache_create_date' => date('Y-m-d')]);
        }catch (Exception $e){
            \Log::error($this->log_name.'Database Update Error. '.$e);
        }
    }

    private function updateEventUrlNothingOGP($event_url_id,$ogp){
        try{
            DB::table('event_url')
            ->where('event_url_id',$event_url_id)
            ->update(['og_title' => $ogp['title'],
                      'og_cache_create_date' => date('Y-m-d')]);
        }catch (Exception $e){
            \Log::error($this->log_name.'Database Update Error. '.$e);
        }
    }

}
