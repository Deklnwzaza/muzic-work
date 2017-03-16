<?php

namespace App\Http\Controllers;

use App\DurianData;
use Illuminate\Http\Request;

class DurianDataController extends Controller
{
    public function index()
    {
        $durians = DurianData::all();
        return view('index2', ['durians' => $durians]);
    }
    public function getData(Request $request)
    {
        $events = $request->all();
        $ch = curl_init($events['image']);
        for ($x = 0;; $x++) {
            $file_path = 'public/image/durian'.$x.'.jpeg';
            if(!fileExists($file_path)){
                break;
            }
        }
        $fp = fopen('public/image/durian'.$x.'.gif', 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
        $arrData = [
            'num' => $events['num'],
            'image' => $file_path
        ];

        DurianData::create($arrData);
    }
}
