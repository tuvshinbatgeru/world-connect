<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PhotoController extends Controller
{
    //
    static public function savePhoto($photo, $type = 'country')
    {
        $fileName = time() . '-' . $photo->getClientOriginalName();
        
        $img = Image::make($photo->getRealPath());
        $img->save(public_path()
                . '/images/'. $type .'/' 
                . $fileName);

        return \App::make('url')->to('/') . '/images/'. $type .'/' . $fileName;
    }
}
