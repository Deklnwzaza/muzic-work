<?php

namespace App\Http\Controllers;

use App\Weather;
use Illuminate\Http\Request;
use App\Temp;
class BotController extends Controller
{

    public function handleBot(Request $request)
    {
        $events = $request->all();

        if (!is_null($events['events'])) {
            // Loop through each event
            foreach ($events['events'] as $event) {
                // Reply only when message sent is in 'text' format
                if ($event['type'] == 'message' && $event['message']['type'] == 'text') {

                    $text = $event['message']['text'];
                    $replyToken = $event['replyToken'];

                    if (strpos($text, 'เหนื่อยไหม') !== false) {
                        $weathers = Weather::orderBy('id', 'desc')->first();
                        $image = $weathers['image'];
                        $messages1 = [
                            'type' => 'text',
                            'text' => 'ความชื้นของดิน : '.$weathers->soil_humidity.' %/ สภาพอากาศ : '.$weathers->weather.
                                ' / ความกดอากาศ : '.$weathers->pressure.' pha / ความชื้นในอากาศ : '.$weathers->relative_humidity.' % / อุณหภูมิ : '.$weathers->temp.' C /
                                 '.$image.'',
                        ];

//                        $messages2 = [
//                            'type'=> 'image',
//                            'originalContentUrl'=> 'https://example.com/original.jpg',
//                            'previewImageUrl'=> 'https://example.com/preview.jpg'
//                        ];



                        $data = [
                            'replyToken' => $replyToken,
                            'messages' =>[
                                $messages1,
                              //  $messages2,
                                ]
                        ];
                    }
                    /*elseif (strpos($text, 'รูปต้นไม้') !== false){
                        $plant = Plant::all()->last();

                        $messages1 = [
                            'type' => 'image',
                            'originalContentUrl' => 'https://ceresweather.herokuapp.com/api/bot/medium_original_image/'.$plant->id,
                            'previewImageUrl' => 'https://ceresweather.herokuapp.com/api/bot/small_original_image/'.$plant->id
                        ];

                        $data = [
                            'replyToken' => $replyToken,
                            'messages' => [
                                $messages1
                            ],
                        ];
                    }
                    else {
                        $messages1 = [
                            'type' => 'text',
                            'text' => 'พูดอะไรเนี่ย เราฟังไม่รู้เรื่องเลย'
                        ];

                        $data = [
                            'replyToken' => $replyToken,
                            'messages' => [
                                $messages1
                            ],
                        ];
                    }*/
                    else {
                        $messages1 = [
                            'type' => 'text',
                            'text' => 'เหนื่อยมากครับ'
                        ];

                        $data = [
                            'replyToken' => $replyToken,
                            'messages' => [
                                $messages1,
                            ],
                        ];
                    }
                    $url = 'https://api.line.me/v2/bot/message/reply';
                    $post = json_encode($data);

                    self::sendPostRequest($url, $post);
                }
            }
        }
        //echo 'OK';
    }

    public function sendPostRequest($url, $data)
    {
        $access_token = '+NoPJXfRFjYWOntlwpyr1l1wPyKqzNk/6vp7wS8eGwy0GKdxDtBc6LpZfHGz6duJrjtYkVJGY33O2r1EaikOGK8+38JbmVOuF5H1tgHh6F+BaZK8OTmKxKJySEemzCVWp+Z47Zpp0KbuHfi8to0BuwdB04t89/1O/w1cDnyilFU=';
        $header = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_FOLLOWLOCATION => 1,
        ));

        $response = curl_exec($curl);
        //$data = json_decode($response, true);
        curl_close($curl);
    }


    function base64_to_jpeg($base64_string, $output_file) {
        $ifp = fopen($output_file, "rb");

        $weathers = Weather::orderBy('id', 'desc')->first();

        $data = explode(',',$base64_string);

        fwrite($ifp, base64_decode($data[1]));
        fclose($ifp);

        return $output_file;
    }
}
