<?php
namespace App\Libs;

class eventDate
{
    public $date;
    public $dd;
    public $current;
    public $type;

    function __construct($date,$dd){
        $this->date = $date;
        $this->dd = $dd;
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