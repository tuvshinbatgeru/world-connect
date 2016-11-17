<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    protected $table = 'news';

	protected $fillable = [
        'title', 'type', 'visit_count'
    ];

    public function info()
    {
    	return $this->morphMany('App\Contentable', 'contentable');
    }

    public function country()
    {
    	return $this->belongsTo('App\Country');
    }
}
