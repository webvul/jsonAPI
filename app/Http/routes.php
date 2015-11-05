<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


//laravel日志
Route::get('laravel/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


Route::controller('api','apiController',[
    'getIndex' => 'api.index',
]);

Route::controller('word','WordController',[
    'getIndex' => 'word.index',
]);

Route::controller('charts','ChartsController',[
    'getIndex' => 'charts.index',
]);

//Event::listen("illuminate.query", function($query, $bindings){
//
//    var_dump($query);//sql 预处理 语句
//
//    var_dump($bindings);// 替换数据
//
//    echo "</br>";
//});



