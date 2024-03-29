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
        if($event['type']=='message'){
            switch($event['message']['type']){
                case 'text':
                $replyToken=$event['replyToken'];

                $respMessage = 'Hello, your message is'. $event['message']['text'];

                $httpClient = new CurlHTTPCLient($channel_token);
                $bot= new LINEBot($httpClient, array('channelSecret' => $channel_secret));
                $textMessageBuilder=new TextMessageBuilder($respMessage);
                $response=$bot->replyMessage($replyToken, $textMessageBuilder);
                break;
            }
        }
    }
} // end if
