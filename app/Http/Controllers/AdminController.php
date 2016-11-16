<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Response;

class AdminController extends Controller
{
	public function delete(Request $request)
	{
		if(!isset($request->file)) {
			return;
		}			

		$filePath = public_path() 
	                      . '/images/news/' 
	                      . explode('news/',$request->file)[1];
		File::delete($filePath);
		return $filePath;
	}
    //
    public function upload(Request $request)
    {
    	$messages = [
            'image.*' => 'Image type must be Jpeg, jpg, png and gif',
            'size' => "photo's size long enought"
        ];

        $validator = Validator::make($request->all(), [
            'image.*' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
        ], $messages);

        if ($validator->fails()) {
            return Response::json([
                    'result' => 'failed', 
                    'errors' => $validator->errors()->getMessages(),
                ]);
        }

        $newPhotos = [];

        foreach ($request->file('files') as $file) 
        {
        	$fileName = time() . '-' . $file->getClientOriginalName();
	        $img = Image::make($file->getRealPath());
	        $img->save(public_path() 
	                      . '/images/news/' 
	                      . $fileName);
	        array_push($newPhotos, array(
	        	'url' => stripslashes(App::make('url')->to('/') . '/images/news/' . $fileName), 
	        	'thumbnail_url' => stripslashes(App::make('url')->to('/') . '/images/news/' . $fileName),
	        	'delete_url' => App::make('url')->to('/') . '/photo/delete/' . $fileName,
	        	'delete_type' => 'DELETE'
	        ));

	        /*$newPhoto = collect([
	        	'url' => stripslashes(App::make('url')->to('/') . '/images/news/' . $fileName), 
	        	'thumbnailUrl' => stripslashes(App::make('url')->to('/') . '/images/news/' . $fileName),
	        	'deleteUrl' => App::make('url')->to('/') . '/photo/delete/' . $fileName,
	        	'deleteType' => 'DELETE'
	        ]);*/
	    }

		return Response::json([
        	'files' => $newPhotos
        ]);

        return Response::json([
        	'files' => $newPhoto->toArray()
        ]);
    }
}
