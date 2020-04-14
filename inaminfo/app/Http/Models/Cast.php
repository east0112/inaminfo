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
  public static function loadCastList(String $cast_type){

    $castList = DB::table("cast")
      ->join("acts","cast.act_id","=","acts.act_id")
      ->where("cast.cast_type","=",$cast_type)
      ->orderByRaw("year ASC")
      ->orderByRaw("cast_id ASC")
      ->get();
    return $castList;
  }

}
