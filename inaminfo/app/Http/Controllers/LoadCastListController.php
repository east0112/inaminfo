<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\requestParameter;
use App\Libs\responceParameter;
use App\Http\Models\Cast;
use App\Http\Models\Article;

class LoadCastListController extends Controller
{

    /**
     * 出演情報取得
     *
     * @param requestParameter $requestParameter
     * @return Array
     */
    public static function loadCastList($requestParameter){
        $responceParameter = new responceParameter();
        $castLoader = new Cast();
        $articleLoader = new Article();
        
        $animeTvLists = LoadCastListController::formatListForYear($castLoader->loadCastList(config('const.CAST_TYPE_ANIME_TV')));
        $gameLists = LoadCastListController::formatListForYear($castLoader->loadCastList(config('const.CAST_TYPE_GAME')));
        $animeMovieLists = LoadCastListController::formatListForYear($castLoader->loadCastList(config('const.CAST_TYPE_ANIME_MOVIE')));
        $article = LoadCastListController::formatListForYear($articleLoader->loadArticle());

        $responceParameter->setParam('anime_tv',$animeTvLists);
        $responceParameter->setParam('game',$gameLists);
        $responceParameter->setParam('anime_movie',$animeMovieLists);
        $responceParameter->setParam('article',$article);

        return $responceParameter->getReturnData();
    }

    /**
     * 出演情報を年単位に分割する
     *
     * @param Array $castList
     * @return Array
     */
    private static function formatListForYear($castList){
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
