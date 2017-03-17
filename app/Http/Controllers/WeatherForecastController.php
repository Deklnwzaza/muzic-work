<?php

namespace App\Http\Controllers;

use App\WeatherForecast;
use Illuminate\Http\Request;

class WeatherForecastController extends Controller
{
    public function index()
    {
        $weathers_forecasts = WeatherForecast::all();
        return view('forecast', ['weathers_forecasts' => $weathers_forecasts]);    }

    public function getForecastData()
    {
        $days = 'http://api.wunderground.com/api/2a042fddca7ac4ea/forecast10day/q/TH/Nonthaburi.json';
        $data = self::curlGetRequest($days);
        $forecastDays = $data['forecast']['simpleforecast']['forecastday'];
        foreach ($forecastDays as $forecastDay){
            if($forecastDay['date']['day'] >= 18 && $forecastDay['date']['day'] < 23){
                $arrData = [
                    'conditions'=> $forecastDay['conditions'],
                    'max_temp'=> $forecastDay['high']['celsius'],
                    'min_temp'=> $forecastDay['low']['celsius'],
                    'Date_Time'=> $forecastDay['date']['pretty'],
                    'ave_humidity' => $forecastDay['avehumidity']
                ];
                WeatherForecast::create($arrData);
            }

        }

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
