<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\requestParameter;
use App\Libs\responceParameter;
use App\Libs\paginateCreater;
use App\Http\Models\Event;

class LoadEventListsController extends Controller
{
    /**
     * イベントリスト取得
     *
     * @param requestParameter $requestParameter
     * @return Array
     */
    public static function loadEventLists($requestParameter){
      $responceParameter = new responceParameter();
      $eventLoader = new Event();

      // リクエストパラメーターの格納
      $search_word = $requestParameter->getParam('search_word');
      $type = $requestParameter->getParam('type');
      $order = $requestParameter->getParam('order');
      $from = $requestParameter->getParam('from');
      $to = $requestParameter->getParam('to');
      $page = $requestParameter->getParam('page');

      // 検索条件に合致する全件の取得
      $eventLists = $eventLoader->loadEventLists($search_word,$type,$order,$from,$to,$page);

      // ページネーション処理
      $paginateCreater = new paginateCreater($eventLists);
      $current_page = ($page) ?: 1;
      if(!$paginateCreater->createPaginate($current_page)){
        $responceParameter->setResponceCode(config('const.RESPONCE_ERROR_CODE'));
        return $responceParameter->getReturnData();
      }

      $responceParameter->setParam('eventLists',$paginateCreater->getDisplayItems());
      $responceParameter->setParam('paginate',$paginateCreater->getPaginate());
      $responceParameter->setParam('current_page',$paginateCreater->getCurrentPage());
      $responceParameter->setParam('max_page',$paginateCreater->getMaxPage());

      return $responceParameter->getReturnData();
    }

  }
