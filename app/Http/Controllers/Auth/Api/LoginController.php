<?php

namespace App\Http\Controllers\Auth\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Token;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $user = User::exists($request->get('email'), $request->get('password'));

        return Token::get($request);

    }

    private function validateLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
    }
}
