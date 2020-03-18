<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\requestParameter;
use App\Libs\responceParameter;
use App\Libs\paginateCreater;
use App\Http\Models\Event;

class LoadEventController extends Controller
{
    /**
     * イベント取得
     *
     * @param requestParameter $requestParameter
     * @return Array
     */
    public static function loadEvent($requestParameter){
        $responceParameter = new responceParameter();
        $eventLoader = new Event();
        if(!$requestParameter->getParam('event_id') || !is_numeric($requestParameter->getParam('event_id'))){
          $responceParameter->setResponceCode(config('const.RESPONCE_ERROR_CODE'));
          return $responceParameter->getReturnData();
        }

        $responceParameter->setParam('event',$eventLoader->loadEvent($requestParameter->getParam('event_id')));

        return $responceParameter->getReturnData();
    }

  }
