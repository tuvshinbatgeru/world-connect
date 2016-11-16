<?php

namespace App\Http\Controllers;

use App\Contentable;
use App\Country;
use App\Http\Controllers\PhotoController;
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
        $country = new Country;
        $country->name = $param->country_name;
        $country->short_name = $param->country_name;

        $flag = $request->flag;
        $cover = $request->cover;

        $country->flag_url = PhotoController::savePhoto($flag, 'country');
        $country->cover_url = PhotoController::savePhoto($cover, 'country');
        $country->save();

        $country->countryInformation()->attach($this->createContent($country, $param->country_info)->id, [
            'info_id' => 1
        ]);

        $country->countryEducation()->attach($this->createContent($country, $param->country_education)->id, [
            'info_id' => 2
        ]);

        $country->countryVisa()->attach($this->createContent($country, $param->country_visa)->id, [
            'info_id' => 3
        ]);

        return Response::json([
            'code' => 0,
            'country' => $country,
            'message' => 'Амжилттай бүртгэлээ.',
        ]);
    }

    public function createContent($country, $data)
    {
        $content = new Contentable;
        $content->contentable_id = $country->id;
        $content->contentable_type = get_class($country);
        $content->content = stripslashes($data); 

        $content->save();

        return $content;        
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
