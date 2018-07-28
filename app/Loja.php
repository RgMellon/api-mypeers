<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loja extends Model
{
    protected $fillable = ['nome', 'endereco', 'bairro', 'img',
                'numero', 'wp', 'tell', 'sobre', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produto()
    {
        return $this->hasMany(Produto::class);
    }

}
