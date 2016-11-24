<?php

namespace App\Http\Controllers;

use App;
use App\Album;
use App\Http\Controllers\PhotoController;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Response;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.album.index');
    }

    public function albums(Request $request)
    {
        $query = Album::with('pinnedPhoto', 'country')
                      ->withCount('photos')
                      ->latest()->limit(10)->get();

        return Response::json([
            'code' => 0,
            'result' => $query,
        ]);
    }

    public function photos(Album $album)
    {
        return Response::json([
            'code' => 0,
            'result' => $album->photos,
        ]);
    }

    public function list(Request $request)
    {
        $query = Album::with('pinnedPhoto', 'country')
                      ->withCount('photos');

        if($request->filter == 'newest') {
            $query = $query->latest();
        }

        if($request->filter == 'most') {
            $query = $query->orderBy('photos_count', 'DESC');
        }

        if($request->country != 0) {
            $query = $query->where('country_id', $request->country);
        }

        return Response::json([
            'code' => 0,
            'result' => $query->paginate(10)
        ]);
    }

    public function check(Request $request)
    {
        $title = $request->title;

        if(Album::where('title', $title)->exists()) {
            return Response::json([
                'code' => 1,
                'message' => 'Цомгийн гарчиг давхцаж байна.'
            ]);
        }

        return Response::json([
            'code' => 0,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function uploadPhotos(Request $request)
    {
        //dd($request->all());
        $messages = [
            'image.*' => 'Зурган файлын төрөл Jpeg, jpg, png ба gif байх хэрэгтэй.',
            'size' => "Файлын хэмжээ хэт их байна."
        ];

        $validator = Validator::make($request->all(), [
            'image.*' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
        ], $messages);

        if ($validator->fails()) {
            return Response::json([
                    'code' => 1,
                    'message' => $validator->errors()->getMessages(),
            ]);
        }

        $file = $request->file;

        $fileName = time() . '-' . $file->getClientOriginalName();
        $img = Image::make($file->getRealPath());

        $img->save(public_path() 
                . '/images/album/' 
                . $fileName);

        $newPhoto = new Photo;     
        $newPhoto->url = App::make('url')->to('/') . '/images/album/' . $fileName;
        $newPhoto->save();

        return Response::json([
            'code' => 0,
            'result' => $newPhoto,
            'message' => 'Амжилттай хууллаа.'
        ]);
    }

    public function deletePhoto(Photo $photo)
    {
        //Delete absolute path as well
        PhotoController::deletePhoto($photo);
        $photo->delete();        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $param = json_decode($request->data);
        $album = new Album;
        $album->title = $param->album_title;
        $album->country_id = $param->country_id;

        $album->save();

        $photo_id_array = [];

        for ($i = 0; $i < count($param->photos); $i++) {
            $photo_id_array[$param->photos[$i]->id] = [
                'pinned' => $param->photos[$i]->pivot->pinned,
                'caption' => $param->photos[$i]->pivot->caption,
            ];  
        }

        $album->photos_count = count($photo_id_array);
        $album->photos()->sync($photo_id_array);
        $album->pinnedPhoto;

        return Response::json([
            'code' => 0,
            'result' => $album,
            'message' => 'Амжилттай хадгаллаа.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        $album->photos;

        return Response::json([
            'code' => 0,
            'result' => $album
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $param = json_decode($request->data);
        $album = Album::find($id);
        $album->title = $param->album_title;
        $album->country_id = $param->country_id;

        $album->save();

        $photo_id_array = [];

        for ($i = 0; $i < count($param->photos); $i++) {
            $photo_id_array[$param->photos[$i]->id] = [
                'pinned' => $param->photos[$i]->pivot->pinned,
                'caption' => $param->photos[$i]->pivot->caption,
            ];  
        }

        $album->photos_count = count($photo_id_array);
        $album->photos()->sync($photo_id_array);
        $album->pinnedPhoto;
        $album->country;

        return Response::json([
            'code' => 0,
            'result' => $album,
            'message' => 'Амжилттай засварлалаа.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Album::destroy($id);

        return Response::json([
            'code' => 0,
            'message' => 'Амжилттай устгалаа.',
        ]);
    }
}
