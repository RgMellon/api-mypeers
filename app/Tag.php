<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['tag'];

    public function  produtos()
    {
        return $this->belongsToMany(Produto::class);
    }

    public function busca(array $tags, Produto $p)
    {
        foreach($tags as $t) {
            $item = Tag::where('tag', $t)->get();
            if(count($item) == 0){
                $tag = Tag::create(['tag' => $t]);
                $p->tags()->attach($tag);
            }else{
                $p->tags()->attach($item);
            }
        }
    }
}
