<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;

class Tag
{


  function __construct(){
    $this->param = array();
  }

  /**
   * タグデータの取得（検索）
   *
   * @return items $items
   */
  public function loadTags($search_word = false,$limit = false){
    $eloquent = DB::table("tags");
    if($search_word){
      $eloquent->where('tag_name', 'LIKE', "%$search_word%");
    }
    if($limit){
      $eloquent->limit($limit);
    }
    //あとで直す
    $tmpItems = $eloquent->get();
    $items = array();
    foreach($tmpItems as $item){
      $items[] = $item->tag_name;
    }
    return $items;
  }

}
