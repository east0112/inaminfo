<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/vue/load_api', 'VueApiController@load'); //テスト用　あとで消すこと
Route::post('/vue/load_api', 'VueApiController@load');
Route::get('/{any}', function () {
    return view('view');
})->where('any', '.*');