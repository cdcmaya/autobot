<?php 
require_once('vendor/autoload.php');

//Namespace

use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;



$content = file_get_contents('php://input');
$events=json_decode($content,true);

if(!is_null($events['events'])){
    foreach($events['events'] as $event){
        $replyToken = $event['replyToken'];
        $ask = $event['message']['text'];
        switch(strtolower($ask)){
            case 'm':
                $repMessage = 'What sup man!!';
                break;
            case 'f':
                $repMessage = 'Love you lady';
                break;
            default:
                $repMessage = 'Where is Your Sex ?';
                break;
        }
        $httpClient = new CurlHTTPClient($channel_token);
        $bot = new LINEBot($httpClient,array('channelSecret'=>$channel_secret));

        $textMessageBuilder = new TextMessageBuilder($repMessage);
        $response = $bot->replyMessage($replyToken,$textMessageBuilder);
    }
} // end if
echo "ok";