<?php
namespace App\Libs;

class eventDate
{
    public $date;
    public $current;
    public $type;

    function __construct($date){
        $this->date = $date;
        $this->type = array();
        $this->current = false;
    }

    public function setCurrent($boolean){
        $this->current = $boolean;
    }

    public function setType($key){
        $this->type[$key] = true;
    }


}