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
      //if(!$request->ajax()) return redirect('/');
      $requestParameter = new requestParameter($request->input('mode'));
      // mode判定
      if(!$requestParameter->getMode()) return redirect('/');

      switch($requestParameter->getMode()){
          case 'event':
            $requestParameter->setParam('event_id',$request->input('event_id'));
            $returnData = LoadController::loadEvent($requestParameter);
            break;

          case 'eventLists':

            break;

          case 'tickets':

            break;

          case 'calendar':

            break;

          default:
            return redirect('/');
            break;
      }

      return response()->json($returnData);
      }      
  }
