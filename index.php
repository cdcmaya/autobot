<?php 
require_once('vendor/autoload.php');

//Namespace

use \LINE\LINEBot\HTTPClient\CurlHTTPCLient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

$channel_token = '2iEX/kCl/EvkVXIIVEEarpOFPfSjqIW7/D5SsNxlGAtMAhCPSeXIzlgCgKdBpNRFWyBdMWGfcsEQKwjZS9soJ3hmSDIllq9enlC6eZsm+91MJUXvEtrObJFmozB7m9Uksaqg10XmJzIBVjR4e2XbyAdB04t89/1O/w1cDnyilFU=';
$channel_secret = '0fd52b7e11735fb95aa778ad1dcf7547';

$content = file_get_contents('php://input');
$events=json_decode($content,true);

if(!is_null($events['events'])){
    foreach($events['events'] as $event){
        if($event['type']=='message'){
            switch($event['message']['type']){
                case 'text':
                $replyToken=$event['replyToken'];

                $respMessage = 'Hello, your message is'.$event['message']['text'];

                $httpClient = new CurlHTTPCLient($channel_token);
                $bot= new LINEBot($httpClient, array('channelSecret' => $channel_secret));
                $textMessageBuilder=new TextMessageBuilder($respMessage);
                $response=$bot->replyMessage($replyToken, $textMessageBuilder);
                break;
            }
        }
    }
} // end if