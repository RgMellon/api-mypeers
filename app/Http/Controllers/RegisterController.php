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
        $data = request()->only('email','name','password');

        $user = \App\User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        
        $request->request->add([
            'grant_type' =>'password',
            'client_id' =>'6',
            'client_secret' =>'OVpBpaUeBbHkFb4FFhGBesZFtCA0PljDbT8BaUMa',
            'username' => $request->get('email'),
            'password' => $request->get('password'),
            'scope' => '*',
        ]);
        
        // Fire off the internal request. 
        $proxy = Request::create(
            'oauth/token',
            'POST'
        );

        return \Route::dispatch($proxy);
    }
}
