<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MathLab extends Model
{
    public $timestamps = true;
    protected $table = 'mathlabs';
    protected $fillable = ['mathlab_image'];
}
