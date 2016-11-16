<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use Response;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.country.index');
    }

    public function list()
    {
        $countries = Country::paginate(5);
        return Response::json([
            'code' => 0,
            'result' => $countries
        ]);
    }

    public function check(Request $request)
    {
        $name = $request->name;

        if(Country::where('name', $name)->exists()) {
            return Response::json([
                'code' => 1,
                'message' => 'Улсын нэр давхцаж байна'
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
        $country = new Country();
        $country->name = $param->country_name;
        $country->short_name = $param->country_name;

        $flag = $request->flag;
        $cover = $request->cover;

        $fileName = time() . '-' . $flag->getClientOriginalName();
        
        $img = Image::make($flag->getRealPath());
        $img->save(public_path() 
                . '/images/news/' 
                . $fileName);
            array_push($newPhotos, array(
                'url' => stripslashes(App::make('url')->to('/') . '/images/news/' . $fileName), 
                'thumbnail_url' => stripslashes(App::make('url')->to('/') . '/images/news/' . $fileName),
                'delete_url' => App::make('url')->to('/') . '/photo/delete/' . $fileName,
                'delete_type' => 'DELETE'
        ));

        dd($request->all());
    }

    public function savePhoto()
    {
        
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
    public function edit($id)
    {
        //
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
        //
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
    }
}
