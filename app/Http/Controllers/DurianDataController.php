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
        $arrData = [
            'num' => $events['num'],
            'image' => $events['image']
        ];

        DurianData::create($arrData);
    }
}
