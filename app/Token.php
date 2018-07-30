<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Token extends Model
{
   public static function get(Request $request)
   {

    $request->request->add([
        'grant_type' => 'password',
        'client_id' =>'1',
        'client_secret' => 'LTyu72WM7iU43ANbjRq5MpiaGojGn0DFph1ciUys',
        'username' => $request->get('email'),
        'password' => $request->get('password'),
        'scope' => '*',
    ]);

    // Faz um requisição interna para o oauth
    $proxy = Request::create(
        'oauth/token',
        'POST'
    );

    return \Route::dispatch($proxy);
   }
}
