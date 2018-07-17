<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Tag;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->prefix('v1')->group(function() {
    
//    Route::get('produtos', 'ProdutosController@getAll')->name('produtos');
    //aqui vai as rotas
});

Route::group(['prefix' => 'v1'], function() {
    Route::get('produtos', 'ProdutosController@getAll')->name('produtos');
    Route::get('produtos/{id}', 'ProdutosController@getById')->name('get.produto');
    Route::post('produtos', 'ProdutosController@store')->name('store.produto');
    Route::post('lojas', 'LojasController@store')->name('store.loja');
    Route::get('lojas', 'LojasController@getAll')->name('lojas');
    Route::get('tags', 'TagsController@getAll')->name('tags');
    Route::get('tag/{id}', 'TagsController@getProdByTagId')->name('tag.get');
});

Route::post('register', 'RegisterController@register')->name('register');
// Route::get('search/', function(){
//     $queryString = Input::get('queryString');
//     $user = Tag::where('tag', 'like', "%$queryString%")->get();
//     return response()->json($user);
// });