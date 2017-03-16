<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //

    protected $tale = 'notes';

    public $timestamps = true;

    protected $fillable = [
        'title', 'content',
    ];
}
