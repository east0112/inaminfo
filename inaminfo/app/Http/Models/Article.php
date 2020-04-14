<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\DB;

class Article
{


  function __construct(){
    $this->param = array();
  }

  /**
   * インタビュー記事の取得
   *
   * @param String $cast_id
   * @return array $Castlist
   */
  public static function loadArticle(){

    $article = DB::table("articles")
      ->orderByRaw("year ASC")
      ->orderByRaw("article_id ASC")
      ->get();
    return $article;
  }

}
