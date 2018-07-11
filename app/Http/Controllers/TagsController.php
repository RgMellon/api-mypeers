<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
    public function getAll()
    {
        return Tag::all();
    }

    public function getProdByTagId($id)
    {
        $t = Tag::find($id);
        return $t->produtos;
    }
}
