<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'country';

	protected $fillable = [
        'name', 'short_name', 'flag_url'
    ];

    public function schools()
    {
    	return $this->hasMany('App\School');
    }

    public function countryInformation()
    {
    	return $this->belongsToMany('App\Contentable', 'country_info', 'country_id', 'contentable_id')->wherePivot('info_id', 1);
    }

    public function countryEducation()
    {
    	return $this->belongsToMany('App\Contentable', 'country_info', 'country_id', 'contentable_id')->wherePivot('info_id', 2);
    }

    public function countryVisa()
    {
    	return $this->belongsToMany('App\Contentable', 'country_info', 'country_id', 'contentable_id')->wherePivot('info_id', 3);
    }

    public function albums()
    {
    	return $this->hasMany('App\Album');
    }

    public function news()
    {
    	return $this->hasMany('App\News');
    }
}
