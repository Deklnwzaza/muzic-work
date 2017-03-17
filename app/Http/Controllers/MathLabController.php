<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MathLabController extends Controller
{
    public function getPiImage()
    {
        $w = Weather::orderBy('id', 'desc')->first();
        return response($w->image)->header('Content-Type', 'image/jpg');
    }
}
