<?php

namespace App\Service;

use GuzzleHttp\Client;

class ImageBBService
{
    private $client;

    const TIME_OUT = 30;
    const CONNECT_TIME_OUT = 30;

    public function __construct()
    {
        $this->client = new Client(
            [
                'base_uri' => env('IMGBB_URL', ''),
                'timeout' => self::TIME_OUT,
                'connect_timeout' => self::CONNECT_TIME_OUT,
            ]
        );
    }

    public function fail($method, $path, $data, $response)
    {
        $text = '
            <b>[Request]:</b><code>' . request()->fullUrl() . '</code>
            <b>[Method]:</b><code>' . $method . '</code>
            <b>[Path]:</b><code>' . $path . '</code>
            <b>[Data]:</b><code>' . json_encode($data, true) . '</code>
            <b>[Status]:</b><code>' . $response->getStatusCode() . '</code>
            <b>[Body]:</b><code>' . $response->getBody() . '</code>';

        if ($response->getStatusCode() == 400) {
            $res = json_decode($response->getBody(), true);

            return [
                'success' => false,
                'message' => isset($res['message']) ? $res['message'] : 'Có lỗi Khi xử lý dữ liệu từ my - client. Vui lòng thử lại'
            ];
        }

        return [
            'success' => false,
            'message' => 'Có lỗi Khi xử lý dữ liệu từ my - client. Vui lòng thử lại'
        ];
    }

    public function sendImage ($data) 
    {
        $path = env('IMGBB_URL', '');
        $method = 'POST';
        $response = $this->client->request($method, $path, [
            'verify' => false,
            'http_errors' => false,
            'form_params' => [
                'image' => $data,
                'key' => env('IMGBB_KEY', '')
            ]
        ]);

        if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
            return json_decode($response->getBody(), true);
        }

        return $this->fail($method, $path, $data, $response);
    }
}