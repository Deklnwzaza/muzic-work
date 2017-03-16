<?php

namespace App\Http\Controllers;

use App\Weather;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function index()
    {
        $weathers = Weather::all();
        return view('index', ['weathers' => $weathers]);
    }

    public function getWeather(Request $request)
    {
        $events = $request->all();
        $cur = 'http://api.wunderground.com/api/2a042fddca7ac4ea/conditions/q/TH/Bangkok.json';
        $data = self::curlGetRequest($cur);
        $arrData = [
            'temp' => $data['current_observation']['temp_c'],
            'weather' => $data['current_observation']['weather'],
            'pressure' => $data['current_observation']['pressure_mb'],
            'relative_humidity' => $data['current_observation']['relative_humidity'],
            'soil_humidity' => $request['soil_humidity'],
            'image' => $request['image']
        ];

        Weather::create($arrData);
    }

    public function curlGetRequest($url)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36'
        ));

        $response = curl_exec($curl);
        $data = json_decode($response, true);
        curl_close($curl);

        return $data;
    }
}
