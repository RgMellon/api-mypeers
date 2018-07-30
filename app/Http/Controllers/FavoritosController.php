<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache;

class FavoritosController extends Controller
{
    public function setFav()
    {
        $expiration = 60; //minutos * 24 = um dia
        $key = 'user_';

        // se a chave n for localizada, então executa o callback
        return Cache::remember($key, $expiration, function() {
            // faz a busca e salva por 60 segundos
        });

    }
}
