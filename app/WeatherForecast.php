<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeatherForecast extends Model
{
    public $timestamps = true;
    protected $table = 'weather_historys';
    protected $fillable = ['conditions', 'max_temp', 'min_temp', 'Date-Time', 'ave_humidity'];
}
