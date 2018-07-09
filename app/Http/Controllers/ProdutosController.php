<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\ImgUpload;

class ProdutosController extends Controller
{
    public function getAll()
    {
        return Produto::orderBy('created_at', 'desc')->get();
    }

    public function getById($id)
    {
        return Produto::find($id);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'img' => 'required|image64:jpeg,jpg,png,gif',
            'nome' => 'required',
            'preco' => 'required',
            'loja_id' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }else{
            $img = new ImgUpload();
            $imgame = $img->upload($request->get('img'));
        }

        Produto::create([
            'img' => $imgame,
            'preco' => $request->get('preco'),
            'descricao' => $request->get('descricao'),
            'nome' => $request->get('nome'),
            'loja_id' => $request->get('loja_id')
        ]);

        return response()->json(['sucess' => true]);
    }

}
