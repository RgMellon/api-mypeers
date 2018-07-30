<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Image;

class ImgUpload extends Model
{
    private $imgD;

    public function upload($imageData) {
        $fileName = $this->nameImgRandom($imageData);

        Image::cache(function($image) {
            $image->make($this->imgD)->resize(320, null, function ($constraint) {
                    $constraint->aspectRatio();
            });
        },10, true)->save(public_path('images/prod/').$fileName, 80);

        return $fileName;
    }

    public function uploadBannerLoja($imageData) {
        $fileName = $this->nameImgRandom($imageData);

        Image::cache(function($image) {
            $image->make($this->imgD)->resize(null, 300, function ($constraint) {
                    $constraint->aspectRatio();
            });
        },10, true)->save(public_path('images/loja/').$fileName, 90);

        return $fileName;
    }

    private function nameImgRandom($imageData)
    {
        $this->imgD = $imageData;

        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.'
        .explode('/', explode(':', substr($imageData, 0, strpos($imageData,';')))[1])[1];

        return $fileName;
    }
}
