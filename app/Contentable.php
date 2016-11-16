<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contentable extends Model
{
    //
    const NEWS_ID = 1;
    const COUNTRY_ID = 2;

    protected $table = 'contentable';

	protected $fillable = [
        'contentable_type', 'content'
    ];


}
