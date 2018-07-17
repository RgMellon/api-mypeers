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
        return $request->get('email');
        $request->request->add([
            'grant_type' =>'password',
            'client_id' =>'4',
            'client_secret' =>'VqtNcsODSTokYkmmeZzWHanouYVr0RarH9wIBaRS',
            'username' => $request->get('email'),
            'password' => $request->get('password'),
            'scope' => null,
            'redirect_uri' => url('/callback'),
        ]);
        
        // Fire off the internal request. 
        $proxy = Request::create(
            'oauth/token',
            'POST'
        );

        return \Route::dispatch($proxy);
    }
}
