<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;



Route::middleware('auth:api')->get('/user', 'UserController@user');

Route::middleware('auth:api')->prefix('v1')->group(function() {

    //aqui vai as rotas
});

// Routa das lojas
Route::group(['prefix' => 'v1'], function() {
    Route::post('loja', 'LojasController@store')->name('store.loja')
        ->middleware('auth:api');
    Route::get('lojas', 'LojasController@getAll')->name('lojas');
    Route::get('loja/user/{user}', 'LojasController@getLojaByUser')->name('loja.user');
    Route::get('loja/{loja}', 'LojasController@getLojaById')->name('loja');
    Route::put('loja/{loja}', 'LojasController@update')->name('loja.update')
        ->middleware('auth:api');
    Route::get('loja/produto/{produto}', 'LojasController@getLojaByProduto')->name('loja.produto');
});

// Rota dos Produtos
Route::group(['prefix' => 'v1'], function() {
    Route::get('produtos', 'ProdutosController@getAll')->name('produtos');
    Route::get('produtos/{id}', 'ProdutosController@getById')->name('get.produto');
    Route::get('produtos/loja/{loja}', 'ProdutosController@getProdutoByLoja')
    ->name('get.produto.loja');
});
// Rota dos Produtos admin
Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
    Route::post('produtos', 'ProdutosController@store')->name('store.produto');
    Route::delete('produto', 'ProdutosController@delete')->name('delete.produto');
});

// Rota das Tags
Route::group(['prefix' => 'v1'], function() {
    Route::get('tags', 'TagsController@getAll')->name('tags');
    Route::get('tag/{id}', 'TagsController@getProdByTagId')->name('tag.get');
});


//Rota Favoritos


Route::post('register', 'RegisterController@register')->name('register');
Route::post('login', 'Auth\Api\LoginController@login')->name('login');
