<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
    public function getAll()
    {
        // $min = \Carbon\Carbon::now()->addMinutes(10);
        // $tag = \Cache::remember('api::tag', $min, function () {
        //     return Tag::all();
        // });
        // return $tag;
        return Tag::all();
    }

    public function getProdByTagId($id)
    {
        $t = Tag::find($id);
        return $t->produtos;
    }
}
