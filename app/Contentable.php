<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contentable extends Model
{
    //
    protected $table = 'contentable';

	protected $fillable = [
        'contentable_type', 'content'
    ];
}
