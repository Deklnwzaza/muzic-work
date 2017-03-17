<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeatherForecast extends Model
{
    public $timestamps = true;
    protected $table = 'weather_forecasts';
    protected $fillable = ['conditions', 'max_temp', 'min_temp', 'Date_Time', 'ave_humidity'];
}
