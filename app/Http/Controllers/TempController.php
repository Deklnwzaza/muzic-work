<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Temp;

class TempController extends Controller
{

    public function index()
    {
        $temps = Temp::all();
        return view('index', ['temps' => $temps]);
    }

    public function getDailyWeatherData($day){
        $day = 'http://api.wunderground.com/api/2a042fddca7ac4ea/history_201703'.$day.'/q/TH/BANGKOK.json';
        $data = self::curlGetRequest($day);
        $arrData = [
            'mean_temp'=> $data['history']['dailysummary'][0]['meantempm'],
            'max_temp'=> $data['history']['dailysummary'][0]['maxtempm'],
            'min_temp'=> $data['history']['dailysummary'][0]['mintempm'],
            'Date'=> $data['history']['date']['pretty']
        ];
        Temp::create($arrData);
    }


    public function getTempData()
    {
        $days[0] = 'http://api.wunderground.com/api/2a042fddca7ac4ea/history_20170310/q/TH/BANGKOK.json';
        $days[1] = 'http://api.wunderground.com/api/2a042fddca7ac4ea/history_20170311/q/TH/BANGKOK.json';
        $days[3] = 'http://api.wunderground.com/api/2a042fddca7ac4ea/history_20170312/q/TH/BANGKOK.json';
        $days[4] = 'http://api.wunderground.com/api/2a042fddca7ac4ea/history_20170313/q/TH/BANGKOK.json';
        $days[5] = 'http://api.wunderground.com/api/2a042fddca7ac4ea/history_20170314/q/TH/BANGKOK.json';

        foreach ($days as $day){
            $data = self::curlGetRequest($day);
            $arrData = [
                'mean_temp'=> $data['history']['dailysummary'][0]['meantempm'],
                'max_temp'=> $data['history']['dailysummary'][0]['maxtempm'],
                'min_temp'=> $data['history']['dailysummary'][0]['mintempm'],
                'Date'=> $data['history']['date']['pretty']
            ];

            Temp::create($arrData);
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
