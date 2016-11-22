<?php

namespace App;

use App\Album;
use App\Http\Controllers\PhotoController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Album extends Model
{
    //
    protected $table = 'album';

	protected $fillable = [
        'title'
    ];

    public function photos()
    {
    	return $this->belongsToMany('App\Photo', 'album_photos', 'album_id', 'photo_id')->withPivot('caption', 'pinned')->withTimeStamps();
    }

    public function pinnedPhoto()
    {
    	return $this->photos()->wherePivot('pinned', 1);
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public static function boot()
    {
        parent::boot();
        
        Album::deleting(function($album)
        {   
        	foreach ($album->photos as $photo) {
        		PhotoController::deletePhoto($photo);	
        	}

        	$album->photos()->delete();
        	DB::table('album_photos')->where('album_id', $album->id)->delete();
        });
    }
}
