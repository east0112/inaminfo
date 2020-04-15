<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\requestParameter;
use App\Libs\responceParameter;
use App\Libs\paginateCreater;
use App\Http\Models\Event;
use App\Http\Models\Cast;
use App\Http\Models\Article;

class LoadSearchController extends Controller
{
    /**
     * サイト内検索結果の取得
     *
     * @param requestParameter $requestParameter
     * @return Array
     */
    public static function loadSearchLists($requestParameter){
      $responceParameter = new responceParameter();
      $eventLoader = new Event();
      $castLoader = new Cast();
      $articleLoader = new Article();

      // リクエストパラメーターの格納
      $search_word = $requestParameter->getParam('search_word');

      // 検索条件に合致する全件の取得（イベント）
      $eventLists = $eventLoader->loadEventLists($search_word);

      // ページネーション処理
      $paginateCreater = new paginateCreater($eventLists);
      $current_page = 1;

      $paginateParam = array();
      if(!$paginateCreater->createPaginate($current_page,$paginateParam)){
        $responceParameter->setResponceCode(config('const.RESPONCE_ERROR_CODE'));
        return $responceParameter->getReturnData();
      }
      $responceParameter->setParam('eventLists',$paginateCreater->getDisplayItems());

      // 検索情報に合致する全件の取得（出演情報）
      $animeTvLists = LoadSearchController::formatListForYear($castLoader->loadCastListSearch(config('const.CAST_TYPE_ANIME_TV'),$search_word));
      $gameLists = LoadSearchController::formatListForYear($castLoader->loadCastListSearch(config('const.CAST_TYPE_GAME'),$search_word));
      $animeMovieLists = LoadSearchController::formatListForYear($castLoader->loadCastListSearch(config('const.CAST_TYPE_ANIME_MOVIE'),$search_word));
      $article = LoadSearchController::formatListForYear($articleLoader->loadArticleSearch($search_word));

      $responceParameter->setParam('anime_tv',$animeTvLists);
      $responceParameter->setParam('game',$gameLists);
      $responceParameter->setParam('anime_movie',$animeMovieLists);
      $responceParameter->setParam('article',$article);
      $responceParameter->setParam('total_count',count($eventLists) + count($animeTvLists) + count($gameLists) + count($animeMovieLists) + count($article));

      return $responceParameter->getReturnData();
    }

    /**
     * 出演情報を年単位に分割する
     *
     * @param Array $castList
     * @return Array
     */
    private static function formatListForYear($castList){
      if(!count($castList)) return array();
      $pre_year = false;
      $returnList = array();
      foreach($castList as $cast){
          if($pre_year !== $cast->year){
              if($pre_year){
                  $returnList[$pre_year] = $tmpArray;
              }
              $tmpArray = array();
          }
          $tmpArray[] = $cast;
          $pre_year = $cast->year;
      }
      $returnList[$pre_year] = $tmpArray;
      return $returnList;
  }

}
