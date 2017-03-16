<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temp extends Model
{
    public $timestamps = true;
    protected $table = 'temps';
    protected $fillable = ['mean_temp', 'min_temp', 'max_temp', 'Date'];
}
