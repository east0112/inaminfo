<?php
namespace App\Libs;

class responceParameter
{
    private $param;
    private $responce_code;

    function __construct(){
        $this->param = array();
        $this->responce_code = config('const.RESPONCE_SUCCESS_CODE');
    }

    public function setParam($key,$value){
        $this->param[$key] = $value;
    }

    public function getParam($key){
        return (isset($this->param[$key])) ? $this->param[$key]  :false;
    }

    public function setResponceCode($value){
        $this->responce_code = $value;
    }

    public function getResponceCode($value){
        return $this->responce_code;
    }

    public function getReturnData(){
        $returnParam = $this->param;
        //返却するJSONデータパラメーターが空の場合はエラーコードを設定する。
        if(empty($returnParam)) $this->responce_code = config('const.RESPONCE_ERROR_CODE');
        $returnParam['status_code'] = $this->responce_code;

        return $returnParam;
    }

}