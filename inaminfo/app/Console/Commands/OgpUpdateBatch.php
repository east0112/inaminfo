<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Libs\awsS3Uploader;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

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

    protected $tmp_file_path = '/tmp/';

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
        $event_url_id = 1; //debug
        $img_url = 'http://develop-inami.sakura.ne.jp/images/home001.png'; //debug

        //$img = file_get_contents($img);
        //$s3uploader = new awsS3Uploader($event_url_id,$img);

        $img_path = $this->saveTmpImage($img_url);
        $path = Storage::disk('s3')->putFile('/ogp_image',$img_path,'public');
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
            return false;
        }
        return (file_exists($file_path)) ? $file_path : false;
    }
}
