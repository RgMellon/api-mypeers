<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request) {
        $v = validator($request->only('email', 'name', 'password'), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($v->fails()) {
            return response()->json($v->errors()->all(), 400);
        }
       

        $user = \App\User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('email')),
        ]);
        return $user;
        // $request->request->add([
        //     'grant_type' =>'password',
        //     'client_id' =>'4',
        //     'client_secret' =>'4qwXtzUkvyDYAft2EeSFwgFyolGDy8aia6kH4Spo',
        //     'username' => $request->get('email'),
        //     'password' => $request->get('password'),
        //     'scope' => '*',
        // ]);
        
        // // Fire off the internal request. 
        // $proxy = Request::create(
        //     'oauth/token',
        //     'POST'
        // );

        // return \Route::dispatch($proxy);
    }
}
