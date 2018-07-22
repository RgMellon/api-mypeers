<?php

namespace App\Http\Controllers;
use App\Loja;
use Validator;
use App\User;
use App\ImgUpload;
use Illuminate\Http\Request;

class LojasController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required',
            'bairro' => 'required',
            'endereco' => 'required',
        ]);

        $img = new ImgUpload();
        $imgName = $img->uploadBannerLoja($request->get('img'));

        Loja::create([
            'nome' => $request->get('nome'),
            'bairro' => $request->get('bairro'),
            'endereco' => $request->get('endereco'),
            'numero' => $request->get('numero'),
            'sobre' => $request->get('sobre'),
            'tell' => $request->get('tell'),
            'wp' => $request->get('wp'),
            'user_id' => $request->get('user_id'),
            'img' => $imgName,
        ]);

        return response()->json(['succes' => true], 200);
    }

    public function getAll()
    {
        return Loja::all();
    }

    public function getLojaByUser(User $user)
    {
        return $user->loja;

    }

    public function getLojaById(Loja $loja)
    {
        return $loja;
    }

    public function update(Request $request) {
        return 'entreii aqui';
    }
}
