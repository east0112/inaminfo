<?php
namespace App\Libs;
use Aws\S3\S3Client;
class awsS3Uploader
{
    private $s3client;
    private $aws_access_key_id;
    private $aws_secret_access_key;
    private $s3_bucket_name;
    private $event_url_id;
    private $img;

    function __construct($event_url_id,$img){
        $this->event_url_id = $event_url_id;
        $this->img = $img;
        $this->aws_access_key_id = getenv('AWS_ACCESS_KEY_ID');
        $this->aws_secret_access_key = getenv('AWS_SECRET_ACCESS_KEY');
        $this->s3_bucket_name = getenv('S3_BUCKET_NAME');
        $this->createS3Client();
    }

    public function validStatus(){
        $arrError = array();

        $ext = substr($filename, strrpos($this->img, '.') + 1);
        if(strtolower($ext) !== 'png' && strtolower($ext) !== 'jpg' && strtolower($ext) !== 'jpeg' && strtolower($ext) !== 'gif'){
            $arrError[] = '画像以外のファイルが指定されています。（png/jpg/jpeg/gif）を指定してください。';
        }

        if(!$this->aws_access_key_id) $arrError[] = 'AWS_ACCESS_KEY_IDが.envに設定されていません。';
        if(!$this->aws_secret_access_key) $arrError[] = 'AWS_SECRET_ACCESS_KEYが.envに設定されていません。';
        if(!$this->s3_bucket_name) $arrError[] = 'S3_BUCKET_NAMEが.envに設定されていません。';

        $this->img = $this->encodeBase64($this->img);

        return $arrError;
    }

    private function encodeBase64($img){
        return base64_encode(img);
    }

    private function createS3Client(){
        $s3client = S3Client::factory([
            'credentials' => [
                'key' => $this->aws_access_key_id,
                'secret' => $this->aws_secret_access_key,
            ],
            'region' => 'ap-northeast-1',
            'version' => 'latest',
        ]);
        $this->s3client = $s3client;
    }
}