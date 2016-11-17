<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    //
    protected $table = 'school';

	protected $fillable = [
        'logo_url', 'name', 'cover_url'
    ];

    public function degrees()
    {
    	return $this->belongsToMany('App\Degree', 'school_level', 'school_id', 'degree_id');
    }

    public function info()
    {
	   	return $this->morphMany('App\Contentable', 'contentable');
    }

    public function country()
    {
    	return $this->belongsTo('App\Country');
    }
}
