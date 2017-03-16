<?php

namespace App\Http\Controllers;

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
                        $temps = Temp::orderBy('id', 'desc')->take(5)->get();

                        $messages1 = [
                            'type' => 'text',
                            'text' => 'วันที่ '.$temps[4]->Date.' Mean_Temp = '.$temps[4]->mean_temp.' C/ Max_Temp = '.$temps[4]->max_temp.' C/ Min_Temp = '.$temps[4]->min_temp.' C'
                        ];

                        $messages2 = [
                            'type' => 'text',
                            'text' => 'วันที่ '.$temps[3]->Date.' Mean_Temp = '.$temps[3]->mean_temp.' C/ Max_Temp = '.$temps[3]->max_temp.' C/ Min_Temp = '.$temps[3]->min_temp.' C'
                        ];

                        $messages3 = [
                            'type' => 'text',
                            'text' => 'วันที่ '.$temps[2]->Date.' Mean_Temp = '.$temps[2]->mean_temp.' C/ Max_Temp = '.$temps[2]->max_temp.' C/ Min_Temp = '.$temps[2]->min_temp.' C'
                        ];

                        $messages4 = [
                            'type' => 'text',
                            'text' => 'วันที่ '.$temps[1]->Date.' Mean_Temp = '.$temps[1]->mean_temp.' C/ Max_Temp = '.$temps[1]->max_temp.' C/ Min_Temp = '.$temps[1]->min_temp.' C'
                        ];

                        $messages5 = [
                            'type' => 'text',
                            'text' => 'วันที่ '.$temps[0]->Date.' Mean_Temp = '.$temps[0]->mean_temp.' C/ Max_Temp = '.$temps[0]->max_temp.' C/ Min_Temp = '.$temps[0]->min_temp.' C'
                        ];

                        $data = [
                            'replyToken' => $replyToken,
                            'messages' => [
                                $messages1,
                                $messages2,
                                $messages3,
                                $messages4,
                                $messages5
                            ],
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
}
