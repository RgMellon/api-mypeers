<?php

namespace App\Http\Controllers\Auth\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            'password' => Hash::make($request->get('password')),
        ]);
        
        $request->request->add([
            'grant_type' =>'password',
            'client_id' =>'5',
            'client_secret' => 'yDmeB2oLndq4nQnHrrlRuwX5AwttoAvRSeSgvVB7',
            'username' => $request->get('email'),
            'password' => $request->get('password'),
            'scope' => '*',
        ]);
        
        // // Fire off the internal request. 
        $proxy = Request::create(
            'oauth/token',
            'POST'
        );

        return \Route::dispatch($proxy);
    }
}
