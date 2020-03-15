<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;

class eventLoader
{


  function __construct(){
    $this->param = array();
  }

  /**
   * 一覧表示用データの取得（検索）
   *
   * @return items $items
   */
  public function loadEventLists($search_word = false,
                                $type = false,
                                $order = false,
                                $from = false,
                                $to = false,
                                $page = false){

    $param = array();
    $sql = "SELECT events.*  FROM events WHERE 1 = 1 ";
    if($search_word){
      $sql .= " AND (EXISTS(
                    SELECT * FROM (
                    SELECT tr.event_id FROM tag_relations tr INNER JOIN tags t ON tr.tag_id = t.tag_id
                    WHERE t.tag_name LIKE ?) tag_match
                    WHERE events.event_id = tag_match.event_id ) OR events.event_name LIKE ?
                    ) ";
      $param[] = "%$search_word%";
      $param[] = "%$search_word%";
    }
    if($type){
      $tmpTypes = explode(',',$type);
      $inClause = substr(str_repeat(',?', count($tmpTypes)), 1);
      $sql .= sprintf(" AND events.event_type in (%s) ", $inClause);
      foreach($tmpTypes as $tmp_type){
        $param[] = $tmp_type;
      }
    }
    if($from && strptime($from, '%Y-%m-%d')){
      $sql .= " AND events.date >= ? ";
      $param[] = $from;
    }
    if($to && strptime($to, '%Y-%m-%d')){
      $sql .= " AND events.date <= ? ";
      $param[] = $to;
    }
    if($order){
      $sql .= " ORDER BY events.date ASC ";
    }else{
      $sql .= " ORDER BY events.date DESC ";
    } 

    $items = DB::select($sql,$param);
      return $items;
  }

  /**
   * 詳細表示用データの取得（イベント情報）
   *
   * @param String $eventId
   * @return array $eventDetail
   */
  public function loadEvent(String $event_id){

    $eventDetail = DB::table("events")
      ->join("event_type","events.event_type","=","event_type.type_id")
      ->leftjoin("acts","events.act_id","=","acts.act_id")
      ->leftjoin("places","events.place_id","=","places.place_id")
      ->where("events.event_id","=",$event_id)
      ->first();
    return $eventDetail;
  }


}
