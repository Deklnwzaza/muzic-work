<?php

namespace App\Http\Controllers;

use App\Weather;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
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
       // $image = $request->file('pi_image');
        $cur = 'http://api.wunderground.com/api/2a042fddca7ac4ea/conditions/q/CA/San_Francisco.json';
        $data = self::curlGetRequest($cur);
        $pi_img = 'data:image/jpeg;base64,'.base64_decode($request['pi_image']);
        $arrData = [
            'temp' => $data['current_observation']['temp_c'],
            'weather' => $data['current_observation']['weather'],
            'pressure' => $data['current_observation']['pressure_mb'],
            'relative_humidity' => $data['current_observation']['relative_humidity'],
            'soil_humidity' => $request['soil_humidity'],
            'pi_image' => $pi_img
        ];
        Weather::create($arrData);
        return response()->json(['msg' => 'post complete']);
    }

    public function getImage($id)
    {
        $w = Weather::findOrFail($id);

        return response($w->image)->header('Content-Type', 'image/jpg');
    }

    public function getMediumImage($id)
    {
        $w = Weather::findOrFail($id);

        $img = Image::make($w->image)->resize(1024, 1024);

        return $img->response('jpg');
    }

    public function getSmallImage($id)
    {
        $w = Weather::findOrFail($id);

        $img = Image::make($w->image)->resize(240, 240);

        return $img->response('jpg');
    }

    public function getPiImage()
    {
        $w = Weather::orderBy('id', 'desc')->first();
        return response($w->image)->header('Content-Type', 'image/jpg')
            ->json(['id' => $w->id]);
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
