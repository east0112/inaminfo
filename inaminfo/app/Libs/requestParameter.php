<?php
namespace App\Libs;

class requestParameter
{
    private $mode;
    private $param;

    function __construct($mode){
        $this->mode = $mode;
    }

    public function getMode(){
        return $this->mode;
    }

    public function setParam($key,$value){
        $this->param[$key] = $value;
    }

    public function getParam($key){
        return (isset($this->param[$key])) ? $this->param[$key]  :false;
    }

}