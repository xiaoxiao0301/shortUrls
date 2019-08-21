<?php

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

Route::get('/username/{name?}', function ($name = 'short') {
    return $name;
})->where('name', '[A-Za-z]+')->name('names');

Route::get('/test', function() {
    $url = URL::route('names'); // "http://short-connection.cn/username"
    dd($url);
    return Redirect::route('names');
});

/**
 * 短连接
 */

Route::get('/', 'IndexController@index');

Route::post('generate', 'IndexController@doGenerate');


Route::get('{urlCode}','IndexController@shortenedLink');
