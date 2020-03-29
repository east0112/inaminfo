<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\requestParameter;
use App\Libs\responceParameter;
use App\Libs\ogpLoader;
use App\Http\Models\Event;
use App\Http\Models\Song;
use App\Http\Models\Tweet;
use App\Http\Models\Url;

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
        if(!$requestParameter->getParam('event_id') || !is_numeric($requestParameter->getParam('event_id'))){
          $responceParameter->setResponceCode(config('const.RESPONCE_ERROR_CODE'));
          return $responceParameter->getReturnData();
        }
        // イベント詳細情報
        $eventLoader = new Event();
        $responceParameter->setParam('event',$eventLoader->loadEvent($requestParameter->getParam('event_id')));

        // 関連サイト
        $urlLoader = new Url();
        $responceParameter->setParam('url',$urlLoader->loadUrl($requestParameter->getParam('event_id')));

        // 本人ツイート
        $tweetLoader = new Tweet();
        $responceParameter->setParam('tweet',$tweetLoader->loadTweetSelf($requestParameter->getParam('event_id')));

        // セットリスト
        $songLoader = new Song();
        $responceParameter->setParam('song',$songLoader->loadSetlist($requestParameter->getParam('event_id')));

        return $responceParameter->getReturnData();
    }


  }
