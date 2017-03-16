<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    public $timestamps = true;
    protected $table = 'weathers';
    protected $fillable = ['temp', 'weather', 'pressure', 'humidity', 'image'];
}
