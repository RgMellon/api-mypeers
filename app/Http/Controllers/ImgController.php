<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Image;

class ImgController extends Controller
{
    public function resize(Request $request) {
       $data = (string) \Image::make($request->get('img'))->fit(1000, 1000)->encode('data-url');
       return $data;
    }
}
