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
        $ch = curl_init($events['image']);
        for ($x = 0;; $x++) {
            $file_path = 'public/image/pi'.$x.'.jpeg';
            if(!fileExists($file_path)){
                break;
            }
        }
        $fp = fopen('public/image/pi'.$x.'.gif', 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
        $cur = 'http://api.wunderground.com/api/2a042fddca7ac4ea/conditions/q/TH/Bangkok.json';
        $data = self::curlGetRequest($cur);
        $arrData = [
            'temp' => $data['current_observation']['temp_c'],
            'weather' => $data['current_observation']['weather'],
            'pressure' => $data['current_observation']['pressure_mb'],
            'relative_humidity' => $data['current_observation']['relative_humidity'],
            'soil_humidity' => $request['soil_humidity'],
            'image' => $file_path
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

    function base64_to_jpeg($base64_string, $output_file) {
        $ifp = fopen($output_file, "wb");

        $data = explode(',', $base64_string);

        fwrite($ifp, base64_decode($data[1]));
        fclose($ifp);

        return $output_file;
    }
}
