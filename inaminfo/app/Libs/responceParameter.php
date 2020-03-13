<?php
namespace App\Libs;

class responceParameter
{
    private $param;

    function __construct(){
        $this->param = array();
    }

    public function setParam($key,$value){
        $this->param[$key] = $value;
    }

    public function getParam($key){
        return (isset($this->param[$key])) ? $this->param[$key]  :false;
    }

    public function getReturnData(){
        return $this->param;
    }

    /*
    public function getJsonData($generate = false){
        if($generate) $this->generateJsonData();
        return $this->json_data;
    }

    protected function generateJsonData(){
        $this->json_data = json_encode($this->param);
    }
    */
}