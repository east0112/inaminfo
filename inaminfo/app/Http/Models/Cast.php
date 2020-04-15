<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;

class Cast
{


  function __construct(){
    $this->param = array();
  }

  /**
   * 出演履歴データの取得（出演区分毎）
   *
   * @param String $cast_id
   * @return array $Castlist
   */
  public function loadCastList($cast_type){

    $castList = DB::table("cast")
      ->join("acts","cast.act_id","=","acts.act_id")
      ->where("cast.cast_type","=",$cast_type)
      ->orderByRaw("year ASC")
      ->orderByRaw("cast_id ASC")
      ->get();
    return $castList;
  }

  /**
   * 出演履歴データの取得（出演区分毎、全件検索）
   *
   * @param String $cast_type
   * @param String $search_word
   * @return array $Castlist
   */
  public function loadCastListSearch($cast_type,$search_word){
    $param = array($cast_type,$search_word,$search_word);
    $sql = "SELECT * FROM cast 
            INNER JOIN acts ON cast.act_id = acts.act_id 
            WHERE cast.cast_type = ? 
            AND ( cast.cast_name LIKE ? OR acts.name LIKE ?)
            ORDER BY year ASC, cast_id ASC";

    $items = DB::select($sql,$param);
    return $items;
  }
}
