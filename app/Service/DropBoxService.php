<?php
namespace App\Service;

use GuzzleHttp\Client;

class DropBoxService
{
    private $client;

    const TIME_OUT = 30;
    const CONNECT_TIME_OUT = 30;

    public function __construct()
    {
        $this->client = new Client(
            [
                'base_uri' => env('DROPBOX_URL', ''),
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
                'message' => isset($res['message']) ? $res['message'] : 'Có lỗi Khi Vui lòng thử lại'
            ];
        }

        return [
            'success' => false,
            'message' => 'Có lỗi Vui lòng thử lại'
        ];
    }

    public function upload($data) 
    {
        $path = '/files/upload';
        $method = 'POST';
        $response = $this->client->request($method, $path, [
            'verify' => false,
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'Bearer ' . env('DROPBOX_TOKEN'),
                'Content-Type' => 'application/octet-stream',
                'Dropbox-API-Arg' => '{"path":"/'.$path.'", "mode":"add", "autorename": true, "mute": false}'
            ]
        ]);

        if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
            return json_decode($response->getBody(), true);
        }

        return $this->fail($method, $path, $data, $response);
    }

    public function getShareLink($link)
    {
        $path = '/sharing/create_shared_link_with_settings';
        $method = 'POST';
        $response = $this->client->request($method, $path, [
            'verify' => false,
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'Bearer ' . env('DROPBOX_TOKEN'),
                // 'Content-Type' => 'application/octet-stream',
                // 'Dropbox-API-Arg' => '{"path":"/'.$path.'", "mode":"add", "autorename": true, "mute": false}'
            ],
            'json' => [
               'path' => $link 
            ]
        ]);

        dd($response->getStatusCode(), json_decode($response->getBody(), true));
        if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
            return json_decode($response->getBody(), true);
        }

        return $this->fail($method, $path, [], $response);
    }

    public function getTemporaryLink ($link)
    {
        $path = '/files/get_temporary_link';
        $method = 'POST';
        $response = $this->client->request($method, $path, [
            'verify' => false,
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'Bearer ' . env('DROPBOX_TOKEN'),
                // 'Content-Type' => 'application/octet-stream',
                // 'Dropbox-API-Arg' => '{"path":"/'.$path.'", "mode":"add", "autorename": true, "mute": false}'
            ],
            'json' => [
               'path' => $link 
            ]
        ]);

        dd($response->getStatusCode(), json_decode($response->getBody(), true));
        if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
            return json_decode($response->getBody(), true);
        }

        return $this->fail($method, $path, [], $response);
    }
}