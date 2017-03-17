<?php

namespace App\Http\Controllers;

use App\WeatherHistory;
use Illuminate\Http\Request;

class WeatherHistoryController extends Controller
{

    public function index()
    {
        $weathers_historys = WeatherHistory::all();
        return view('history', ['weathers_historys' => $weathers_historys]);    }

    public function getHistoryData()
    {
        $index = 0;
        for($i = 12; $i < 17; ++$i){
            $days[index] = 'http://api.wunderground.com/api/2a042fddca7ac4ea/history_201703'.$i.'/q/TH/BANGKOK.json';
            $index++;
        }

        foreach ($days as $day){
            $data = self::curlGetRequest($day);
            $arrData = [
                'mean_temp'=> $data['history']['dailysummary'][0]['meantempm'],
                'max_temp'=> $data['history']['dailysummary'][0]['maxtempm'],
                'min_temp'=> $data['history']['dailysummary'][0]['mintempm'],
                'Date'=> $data['history']['date']['pretty']
            ];

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
