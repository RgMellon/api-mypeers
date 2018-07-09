<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function() {
    Route::get('produtos', 'ProdutosController@getAll')->name('produtos');
    Route::get('produtos/{id}', 'ProdutosController@getById')->name('get.produto');
    Route::post('produtos', 'ProdutosController@store')->name('store.produto');
    Route::post('lojas', 'LojasController@store')->name('store.loja');
    Route::get('lojas', 'LojasController@getAll')->name('lojas');
    Route::post('img', 'ImgController@resize')->name('img.resize');
});