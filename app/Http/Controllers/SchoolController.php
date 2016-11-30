<?php

namespace App\Http\Controllers;

use App\Contentable;
use App\Country;
use App\Http\Controllers\PhotoController;
use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.school.index');
    }

    public function schools()
    {
        $schools = School::latest()->get();
        return Response::json([
            'code' => 0,
            'result' => $schools
        ]);
    }

    public function all()
    {
        $schools = School::with('degrees', 'country')
                         ->latest()
                         ->paginate(10);
                         
        return Response::json([
            'code' => 0,
            'result' => $schools
        ]);
    }

    public function check(Request $request)
    {
        $name = $request->name;

        if(School::where('name', $name)->exists()) {
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $school = new School;
        $school->name = $request->school_name;
        $school->country_id = Country::where('name', $request->country_name)->first()->id;

        $flag = $request->flag;
        $cover = $request->cover;

        $school->logo_url = PhotoController::savePhoto($flag, 'school');
        $school->cover_url = PhotoController::savePhoto($cover, 'school');
        $school->save();

        $this->createContent($school, $request->school_info);

        $degrees = explode(',', $request->school_degree);

        $school->degrees()->sync($degrees);
        
        $school->country;
        $school->degrees;

        return Response::json([
            'code' => 0,
            'result' => $school,
            'message' => 'Амжилттай бүртгэлээ.',
        ]);
    }

    public function createContent($school, $data)
    {
        $content = new Contentable;
        $content->contentable_id = $school->id;
        $content->contentable_type = get_class($school);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        //
        $school->degrees;
        $school->info;
        $school->country;

        return Response::json([
            'code' => 0,
            'result' => $school
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
        $school = School::find($id);
        $school->name = $request->school_name;
        $school->country_id = Country::where('name', $request->country_name)->first()->id;

        $flag = $request->flag;
        $cover = $request->cover;

        if($flag) {
            $school->logo_url = PhotoController::savePhoto($flag, 'school');
        }

        if($cover) {
            $school->cover_url = PhotoController::savePhoto($cover, 'school');
        }

        $school->save();

        DB::table('contentable')->where('contentable_id', $school->id)->where('contentable_type', 'App\\School')->delete();

        $this->createContent($school, $request->school_info);

        $degrees = explode(',', $request->school_degree);

        $school->degrees()->sync($degrees);
        $school->degrees;

        return Response::json([
            'code' => 0,
            'result' => $school,
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
        DB::table('school_level')->where('school_id', $id)->delete();
        School::destroy($id);
        DB::table('contentable')->where('contentable_id', $id)->where('contentable_type', 'App\\School')->delete();

        return Response::json([
            'code' => 0,
            'message' => 'Амжилттай устгалаа.'
        ]);
    }
}
