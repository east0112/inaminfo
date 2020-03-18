<?php
namespace App\Libs;
use Carbon\Carbon;
use App\Http\Models\Event;

class calendarCreater
{
    private $year;
    private $month;
    private $events;

    function __construct($year,$month){
        $this->year = $year;
        $this->month = $month;
    }

    public function setYear($year){
        $this->year = $year;
    }

    public function setMonth($month){
        $this->month = $month;
    }

    public function setEvents($events){
        $this->events = $events;
    }

    public function createEventCalendar(){
        if(!$this->year || !$this->month || !$this->events) return false;

        $current_date = sprintf('%04d-%02d-01', $this->year, $this->month);
        $current_month = sprintf('%04d-%02d', $this->year, $this->month);
        $date = new Carbon($current_date);

        // カレンダーを四角形にするため、前月となる左上の隙間用のデータを入れるためずらす
        $date->subDay($date->dayOfWeek);
        // 同上。右下の隙間のための計算。デフォルトで6週計算にする
        $count = 38 + $date->dayOfWeek;
        $count = ceil($count / 7) * 7;
        $dates = [];

        for ($i = 0; $i < $count; $i++, $date->addDay()) {
            $tmp_date = $date->format('Y-m-d');
            $tmp_date_dd = $date->format('j');
            $eventDate = new eventDate($tmp_date,$tmp_date_dd);
            if($current_month === $date->format('Y-m')) $eventDate->setCurrent(true);

            foreach($this->events as $event){
                if($event->date === $tmp_date){
                    if($event->event) $eventDate->setType('event');
                    if($event->radio) $eventDate->setType('radio');
                    if($event->magazine) $eventDate->setType('magazine');
                    if($event->program) $eventDate->setType('program');
                    if($event->stage) $eventDate->setType('stage');
                    break;
                }
            }
            $dates[] = $eventDate;
        }
        return $dates;


    }
}