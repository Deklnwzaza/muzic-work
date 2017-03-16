<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeatherHistory extends Model
{
    public $timestamps = true;
    protected $table = 'weather_historys';
    protected $fillable = ['mean_temp', 'min_temp', 'max_temp', 'Date'];
}
