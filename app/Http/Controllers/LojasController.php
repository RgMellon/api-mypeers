<?php

namespace App\Http\Controllers;
use App\Loja;
use Validator;
use App\User;
use App\ImgUpload;
use Illuminate\Http\Request;
use App\Produto;

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

    public function update(Request $request, Loja $loja) {
        // o request->img vem no formato data:base64 do front,
        // aqui é verificado se esta nesse formato, pegando a primeira cadeia
        // e verificando se é data
        // se estiver, então faz update da imagem.
        $existsData = substr($request->get('img'), 0,  4);
        if($existsData == 'data')
        {
            $img = new ImgUpload();
            $imgName = $img->uploadBannerLoja($request->get('img'));

            $loja->update([
                'img' => $imgName,
                'nome' => $request->get('nome'),
                'bairro' => $request->get('bairro'),
                'endereco' => $request->get('endereco'),
                'numero' => $request->get('numero'),
                'sobre' => $request->get('sobre'),
                'tell' => $request->get('tel'),
                'wp' => $request->get('wp'),
            ]);

            return $loja;

        } else {

            $loja->update([
                'nome' => $request->get('nome'),
                'bairro' => $request->get('bairro'),
                'endereco' => $request->get('endereco'),
                'numero' => $request->get('numero'),
                'sobre' => $request->get('sobre'),
                'tell' => $request->get('tel'),
                'wp' => $request->get('wp'),
            ]);

            return $loja;
        }
    }

    public function getLojaByProduto(Produto $produto)
    {
        return $produto->loja;
    }
}
