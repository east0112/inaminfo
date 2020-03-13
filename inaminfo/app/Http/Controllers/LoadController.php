<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\requestParameter;
use App\Libs\responceParameter;

class LoadController extends Controller
{
    /**
     * イベント取得
     *
     * @param requestParameter $requestParameter
     * @return Array
     */
    public static function loadEvent($requestParameter){
        $responceParameter = new responceParameter();
        $responceParameter->setParam('word',$requestParameter->getParam('word'));
        $responceParameter->setParam('xxx','afafa');

        return $responceParameter->getReturnData();
    }

    /**
     * イベントリスト取得
     *
     * @param requestParameter $requestParameter
     * @return Array
     */
    private static function loadEventLists($requestParameter){
      $responceParameter = new jsonManager();

      return $responceParameter->getReturnData();
    }

    /**
     * チケットリスト取得
     *
     * @param requestParameter $requestParameter
     * @return Array
     */
    private static function loadTickets($requestParameter){
      $responceParameter = new jsonManager();

      return $responceParameter->getReturnData();
    }

    /**
     * カレンダー取得
     *
     * @param requestParameter $requestParameter
     * @return Array
     */
    private static function loadCalendar($requestParameter){
      $responceParameter = new jsonManager();

      return $responceParameter->getReturnData();
    }

  }
