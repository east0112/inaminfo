<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;

class Tweet
{


  function __construct(){
    $this->param = array();
  }

  /**
   * 詳細表示用データの取得（ツイート）
   *
     * @param String $eventId
     * @return array $eventTweetSelf
     */
    public static function loadTweetSelf(String $eventId){

      $eventTweetSelf = DB::table("event_tweet_self")
        ->where("event_tweet_self.event_id","=",$eventId)
        ->orderByRaw("event_tweet_self.turn ASC")
        ->get();
      return $eventTweetSelf;
    }

}
