<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Token;

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

        return Token::get($request);
    }
}
