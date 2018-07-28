<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function download()
    {
        $pathToFile = public_path('apk/myPeers.apk');
        $name = 'myPeers.apk';

        return response()->download($pathToFile, $name);
    }
}
