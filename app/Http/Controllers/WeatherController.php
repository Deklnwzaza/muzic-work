<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function index()
    {
        $cur = 'http://api.wunderground.com/api/2a042fddca7ac4ea/conditions/q/TH/Bangkok.json';
        $data = self::curlGetRequest($cur);
        $arrData = [
            'temp' => $data[current_observation][temp_c],
            'weather' => $data[current_observation][weather],
            'relative_humidity' => $data[current_observation][pressure_mb],
            'soil_humidity' => '',
            'image' => ''
        ];
    }
}
