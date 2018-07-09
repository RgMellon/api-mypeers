<?php

namespace App\Http\Controllers;
use App\Loja;
use Validator;

use Illuminate\Http\Request;

class LojasController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required',
            'bairro' => 'required',
            'endereco' => 'required'
        ]);

        Loja::create($request->all());
    }

    public function getAll()
    {
        return Loja::all();
    }
}
