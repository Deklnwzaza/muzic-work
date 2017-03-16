<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherForecastController extends Controller
{
    public function getForecastData()
    {
        $day = 'http://api.wunderground.com/api/2a042fddca7ac4ea/forecast10day/q/TH/BANGKOK.json';
        $index = 0;
        $data = self::curlGetRequest($day);
        foreach ($day['forecast']['simpleforecast']['forecastday'] as $day){
            if(day['date']['day'] >= 18 && day['date']['day'] < 23){
                $arrData = [
                    'conditions'=> $data['conditions'],
                    'max_temp'=> $data['high']['celsius'],
                    'min_temp'=> $data['low']['celsius'],
                    'Date-Time'=> $data['date']['pretty'],
                    'ave_humidity' => $data['ave_humidity']
                ];
            }
            WeatherHistory::create($arrData);
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
