<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;

class ticketLoader
{


  function __construct(){
    $this->param = array();
  }

  /**
   * 抽選期間データの取得（検索）
   *
   * @return items $items
   */
  public function loadCurrentTicketLists($current_time){

    $param = array();

    $sql = "SELECT * FROM tickets 
            WHERE datetime(start_time)  <= datetime(?)
            AND  datetime(end_time)  >= datetime(?)";
    $param[] = $current_time;
    $param[] = $current_time;

    $items = DB::select($sql,$param);
      return $items;
  }



}
