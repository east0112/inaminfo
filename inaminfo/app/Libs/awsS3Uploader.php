<?php
namespace App\Libs;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class awsS3Uploader
{

    protected $s3_cache_dir;

    function __construct(){
        $this->s3_cache_dir = getenv('AWS_PUTDIR');
    }

    public function uploadImage($img_path){
        $path = Storage::disk('s3')->putFile($this->s3_cache_dir,$img_path,'public');
        return $path;
    }
}