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

Route::get('/', function () {
    return 'Homepage';
});


Route::post('/integer/create', 'IntegerController@create');
Route::get('/integer/list', 'IntegerController@list');
Route::get('/integer/top-converted', 'IntegerController@topConverted');
