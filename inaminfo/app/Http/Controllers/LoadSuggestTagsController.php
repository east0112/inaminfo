<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\requestParameter;
use App\Libs\responceParameter;
use App\Libs\paginateCreater;
use App\Http\Models\Tag;

class LoadSuggestTagsController extends Controller
{
    /**
     * サジェストタグ取得
     *
     * @param requestParameter $requestParameter
     * @return Array
     */
    public static function LoadSuggestTags($requestParameter){
        $responceParameter = new responceParameter();
        $tagLoader = new Tag();

        $tags = $tagLoader->loadTags($requestParameter->getParam('search_word'),config('const.EVENT_SEARCH_LIMIT'));

        $responceParameter->setParam('tags',$tags);

        return $responceParameter->getReturnData();
    }

  }
