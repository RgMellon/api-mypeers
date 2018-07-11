<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\ImgUpload;
use App\Tag;

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

    public function store(Request $request, Tag $tag)
    {

        $validator = \Validator::make($request->all(), [
            'img' => 'required|image64:jpeg,jpg,png,gif',
            'nome' => 'required',
            'preco' => 'required',
            'loja_id' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $img = new ImgUpload();
        $imgame = $img->upload($request->get('img'));


        $p = Produto::create([
            'img' => $imgame,
            'preco' => $request->get('preco'),
            'descricao' => $request->get('descricao'),
            'nome' => $request->get('nome'),
            'loja_id' => $request->get('loja_id')
        ]);

        $tag->busca($request->get('tags'), $p);
        return response()->json(['sucess' => true]);
    }

}
