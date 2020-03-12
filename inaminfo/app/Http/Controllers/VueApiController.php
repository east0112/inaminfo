<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VueApiController extends Controller
{
    /**
     * 一覧表示
     *
     * @param Request $request
     * @return Response
     */
    public static function load(Request $request){
      if(!$request->ajax()) return redirect('/');

      $param = array('test' => 'afafa');
      return response()->json($param);
      }
  }
