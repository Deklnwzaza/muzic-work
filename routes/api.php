<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('bot', 'BotController@handleBot');

Route::post('post_weather', 'WeatherController@getWeather');

Route::post('post_durian', 'DurianDataController@getData');

Route::get('/image/l/{id}', 'WeatherController@getImage');

Route::get('/image/m/{id}', 'WeatherController@getMediumImage');

Route::get('/image/s/{id}', 'WeatherController@getSmallImage');

Route::get('get_pi_image', 'WeatherController@getPiImage');

Route::post('data', function (Request $request ){
    $data = $request->all();
    if($data['username'] == 'nnnew'){
        return response("Done");
    }
    else{
        return response("Try Again Bro");
    }

});
