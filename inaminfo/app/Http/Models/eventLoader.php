<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;

class eventLoader
{


  function __construct(){
    $this->param = array();
  }

  /**
   * 詳細表示用データの取得（イベント情報）
   *
   * @param String $eventId
   * @return array $eventDetail
   */
  public function getDetail(String $eventId){

    $eventDetail = DB::table("events")
      ->join("event_type","events.event_type","=","event_type.type_id")
      ->leftjoin("acts","events.act_id","=","acts.act_id")
      ->leftjoin("places","events.place_id","=","places.place_id")
      ->where("events.event_id","=",$eventId)
      ->first();
    return $eventDetail;
  }

  }
