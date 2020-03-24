<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;

class Url
{


  function __construct(){
    $this->param = array();
  }

  /**
   * 詳細表示用データの取得（関連サイト）
   *
   * @param String $eventId
   * @return array $eventUrl
   */
  public static function loadUrl(String $eventId){

    $eventUrl = DB::table("event_url")
      ->where("event_url.event_id","=",$eventId)
      ->get();
    return $eventUrl;
  }

}
