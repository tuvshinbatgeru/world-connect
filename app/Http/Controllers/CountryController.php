<?php

namespace App\Http\Controllers;

use App\Contentable;
use App\Country;
use App\Http\Controllers\PhotoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function currentCountry(Country $country, Request $request)
    {
        $type = $request->type;

        if(!isset($request->type)) {
            $type = 'about';
        } 

        $country->countryInformation;
        $country->countryEducation;
        $country->countryVisa;

        $menu = $type;

        return view('country')->with(compact('country', 'type', 'menu'));
    }

    public function forSite()
    {
        $countries = Country::all();
        return Response::json([
            'code' => 0,
            'result' => $countries
        ]);   
    }

    public function counties()
    {
        $countries = Country::all();
        return Response::json([
            'code' => 0,
            'result' => $countries
        ]);
    }

    public function news(Country $country, Request $request)
    {
        $query = $country->news();

        if($request->type != 0) {
            $type = $request->type;
            $query = $query->where('type', $type);
        
        } else {
            $query = $query->whereNotIn('type', [2, 4]);
        }

        $query = $query->with('info')->latest();

        return Response::json([
            'code' => 0,
            'result' => $query->get(),
        ]);
    }

    public function schools(Country $country, Request $request)
    {
        $query = $country->schools()->with('degrees', 'info');

        if($request->type != 0) {
            $type = $request->type;

            $query = $query->whereHas('degrees', function ($subQuery) use ($type){
                $subQuery->where('id', $type);
            });
        }

        $query = $query->latest();

        return Response::json([
            'code' => 0,
            'result' => $query->get(),
        ]);
    }

    public function all()
    {
        $countries = Country::latest()->paginate(25);
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
        $country = new Country;
        $country->name = $request->country_name;
        $country->short_name = $request->country_name;

        $flag = $request->flag;
        $cover = $request->cover;

        $country->flag_url = PhotoController::savePhoto($flag, 'country');
        $country->cover_url = PhotoController::savePhoto($cover, 'country');
        $country->save();

        $country->countryInformation()->attach($this->createContent($country, $request->country_info)->id, [
            'info_id' => 1
        ]);

        $country->countryEducation()->attach($this->createContent($country, $request->country_education)->id, [
            'info_id' => 2
        ]);

        $country->countryVisa()->attach($this->createContent($country, $request->country_visa)->id, [
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
     * @request  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @request  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        //
        $country->countryInformation;
        $country->countryEducation;
        $country->countryVisa;

        return Response::json([
            'code' => 0,
            'result' => $country,
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
        $country = Country::find($id);
        $country->name = $request->country_name;
        $country->short_name = $request->country_name;

        $flag = $request->flag;
        $cover = $request->cover;

        if($flag) {
            $country->flag_url = PhotoController::savePhoto($flag, 'country');
        }

        if($cover) {
            $country->cover_url = PhotoController::savePhoto($cover, 'country');
        }
        
        $country->save();
        
        DB::table('country_info')->where('country_id', $id)->delete();
        DB::table('contentable')->where('contentable_id', $country->id)->where('contentable_type', 'App\\Country')->delete();

        $country->countryInformation()->attach($this->createContent($country, $request->country_info)->id, [
            'info_id' => 1
        ]);

        $country->countryEducation()->attach($this->createContent($country, $request->country_education)->id, [
            'info_id' => 2
        ]);

        $country->countryVisa()->attach($this->createContent($country, $request->country_visa)->id, [
            'info_id' => 3
        ]);

        return Response::json([
            'code' => 0,
            'country' => $country,
            'message' => 'Амжилттай засварлалаа.',
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
        DB::table('country_info')->where('country_id', $id)->delete();
        Country::destroy($id);
        DB::table('contentable')->where('contentable_id', $id)->where('contentable_type', 'App\\Country')->delete();

        return Response::json([
            'code' => 0,
            'message' => 'Амжилттай устгалаа.'
        ]);
    }
}
