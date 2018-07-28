<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['nome', 'preco', 'descricao', 'img', 'loja_id'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function loja()
    {
        return $this->belongsTo(Loja::class);
    }
}

