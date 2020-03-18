<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\requestParameter;
use App\Libs\responceParameter;
use App\Libs\calendarCreater;
use App\Http\Models\Event;

class LoadCalendarController extends Controller
{
    /**
     * イベント取得
     *
     * @param requestParameter $requestParameter
     * @return Array
     */
    public static function loadCalendar($requestParameter){
        $responceParameter = new responceParameter();
        $year = (is_numeric($requestParameter->getParam('year')) && $requestParameter->getParam('year') > 0 ) ? $requestParameter->getParam('year') : false ;
        $month = (is_numeric($requestParameter->getParam('month')) && $requestParameter->getParam('month') > 0 && $requestParameter->getParam('month') < 13 ) ? $requestParameter->getParam('month') : false ;

        // 年月のいずれかが正しくない場合は、現在年月を設定する。
        if(!$year || !$month){
            $year = date("Y");
            $month = date("m");
        }

        // 月のイベントデータ取得
        $eventLoader = new Event();
        $eventData = $eventLoader->loadEventCalendar(sprintf('%04d-%02d-01', $year, $month));

        $calendarCreater = new calendarCreater($year,$month);
        $calendarCreater->setEvents($eventData);
        //$currentCarendar = $calendarCreater->getCalendarDates();
        $responceParameter->setParam('calendar',$calendarCreater->createEventCalendar());

        //test
        /*
        $responceParameter->setParam('year',$year);
        $responceParameter->setParam('month',$month);
        */
        return $responceParameter->getReturnData();
    }

  }
