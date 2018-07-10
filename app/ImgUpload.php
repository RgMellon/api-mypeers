<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Image;

class ImgUpload extends Model
{
    private $imgD;
    public function upload($imageData) {
        $this->imgD = $imageData;
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.'
        .explode('/', explode(':', substr($imageData, 0, strpos($imageData,';')))[1])[1];

        Image::cache(function($image) {
            $image->make($this->imgD)->fit(200);
        },10, true)->save(public_path('images/prod/').$fileName, 60);

        return $fileName;
    }
}
