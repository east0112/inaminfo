<?php
namespace App\Libs;

class jsonManager
{
    private $param;
    private $json_data;

    function __construct(){
        $this->param = array();
    }

    public function setParam($key,$value){
        $param[$key] = $value;
    }

    public function getParam($key){
        return (isset($param[$key])) ? $param[$key]  :false;
    }

    public function getJsonData($generate = true){
        if($generate) generateJsonData();
        return $this->json_data;
    }

    protected function generateJsonData(){
        $this->json_data = json_encode($this->param);
    }

}