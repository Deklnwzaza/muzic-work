<?php
$access_token = '+NoPJXfRFjYWOntlwpyr1l1wPyKqzNk/6vp7wS8eGwy0GKdxDtBc6LpZfHGz6duJrjtYkVJGY33O2r1EaikOGK8+38JbmVOuF5H1tgHh6F+BaZK8OTmKxKJySEemzCVWp+Z47Zpp0KbuHfi8to0BuwdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;