<?php

namespace App\Services;

use GuzzleHttp\Client;

class TelegramService
{
    private static $_url = 'https://api.telegram.org/bot';
    private static $_token = '5851537576:AAEkTgLQCTG5QLWRkA5_NHOjctU3_wWxhVE';
    private static $_chat_id = '-873608925';
    
    public function __construct()
    {

    }

    public static function sendMessage($text)
    {
        // self::$_chat_id = (env('APP_ENV') == 'prod') ? '-360896807' : '-223267240';
        $uri = self::$_url . self::$_token . '/sendMessage?parse_mode=html';
        $params = [
            'chat_id' => self::$_chat_id,
            'text' => $text,
        ];
        $option['verify'] = false;
        $option['form_params'] = $params;
        $option['http_errors'] = false;
        $client = new Client();
        $response = $client->request("POST", $uri, $option);
        return json_decode($response->getBody(), true);
    }
}
