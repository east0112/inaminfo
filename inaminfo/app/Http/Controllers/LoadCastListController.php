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
     * イベント取得
     *
     * @param requestParameter $requestParameter
     * @return Array
     */
    public static function loadCastList($requestParameter){
        $responceParameter = new responceParameter();
        $castLoader = new Cast();
        $articleLoader = new Article();

        $animeTvLists = $castLoader->loadCastList(config('const.CAST_TYPE_ANIME_TV'));
        $gameLists = $castLoader->loadCastList(config('const.CAST_TYPE_GAME'));
        $animeMovieLists = $castLoader->loadCastList(config('const.CAST_TYPE_ANIME_MOVIE'));
        $article = $articleLoader->loadArticle();

        $responceParameter->setParam('anime_tv',$animeTvLists);
        $responceParameter->setParam('game',$gameLists);
        $responceParameter->setParam('anime_movie',$animeMovieLists);
        $responceParameter->setParam('article',$article);

        return $responceParameter->getReturnData();
    }

  }
