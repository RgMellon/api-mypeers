<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;
    
    protected $fillable = [
        'name', 'email', 'password',
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function exists($email, $password)
    {
        $user =  User::whereEmail($email)->first();
        if ( !$user ) return null;

        if ( Hash::check($password, $user->password) ) {
            return $user;
        } else return null;

    }

    public function loja() {
        return $this->hasOne(Loja::class);
    }
}
