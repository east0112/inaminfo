<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\requestParameter;

class VueApiController extends Controller
{
    /**
     * 一覧表示
     *
     * @param Request $request
     * @return Response
     */

     public static function load(Request $request){
      // ajax通信の判定処理
      //リリース時にコメントは消すこと
      //if(!$request->ajax()) return redirect('/');
      $requestParameter = new requestParameter($request->input('mode'));
      // mode判定
      if(!$requestParameter->getMode()) return redirect('/');

      switch($requestParameter->getMode()){
          case 'event':
            $requestParameter->setParam('event_id',$request->input('event_id'));

            $returnData = LoadEventController::loadEvent($requestParameter);
            break;

          case 'eventLists':
            $requestParameter->setParam('search_word',$request->input('search_word'));
            $requestParameter->setParam('type',$request->input('type'));
            $requestParameter->setParam('order',$request->input('order'));
            $requestParameter->setParam('from',$request->input('from'));
            $requestParameter->setParam('to',$request->input('to'));
            $requestParameter->setParam('page',$request->input('page'));

            $returnData = LoadEventListsController::loadEventLists($requestParameter);
            break;

          case 'tickets':
            $returnData = LoadTicketsController::loadTickets($requestParameter);
            break;

          case 'calendar':
            $requestParameter->setParam('year',$request->input('year'));
            $requestParameter->setParam('month',$request->input('month'));

            $returnData = LoadCalendarController::loadCalendar($requestParameter);
            break;

          case 'suggest_tags':
            $requestParameter->setParam('search_word',$request->input('search_word'));
            $returnData = LoadSuggestTagsController::loadSuggestTags($requestParameter);
            break;

          default:
            return redirect('/');
            break;
      }
      //テスト用
      return json_encode($returnData,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
      //return response()->json($returnData);
      }
  }
