<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;

class Song
{


  function __construct(){
    $this->param = array();
  }

  /**
   * 詳細表示用データの取得（セットリスト）
   *
   * @param String $eventId
   * @return array $eventSetlist
   */
  public static function loadSetlist(String $eventId){

    $eventSetlist = DB::table("event_song")
      ->join("songs","event_song.song_id","=","songs.song_id")
      ->join("setlist_part","event_song.part_id","=","setlist_part.part_id")
      ->where("event_song.event_id","=",$eventId)
      ->orderByRaw("event_song.part_id ASC")
      ->orderByRaw("event_song.rank ASC")
      ->get();
    return $eventSetlist;
  }

}
