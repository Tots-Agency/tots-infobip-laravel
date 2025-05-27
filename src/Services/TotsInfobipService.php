<?php

namespace Tots\Infobip\Services;

use GuzzleHttp\Psr7\Request;

class TotsInfobipService
{
    /**
     *
     * @var array
     */
    protected $config = [];
    /**
     * 
     * @var string
     */
    protected $apiKey = '';
    /**
     * 
     * @var string
     */
    protected $baseUrl = '';
    /**
     * 
     * @var string
     */
    protected $sender = '';
    /**
     * @var \GuzzleHttp\Client
     */
    protected $guzzle;

    public function __construct($config)
    {
        $this->config = $config;
        $this->processConfig();
        $this->guzzle = new \GuzzleHttp\Client();
    }

    public function sendSMS($phone, $text)
    {
        // remove + in phone number
        $phone = str_replace('+', '', $phone);

        return $this->generateRequest('/sms/3/messages', [
            'messages' => [
                [
                    'sender' => $this->sender,
                    'destinations' => [
                        [
                            'to' => $phone,
                        ]
                    ],
                    'content' => [
                        'text' => $text,
                    ]
                ]
            ]
        ]);
    }

    protected function generateRequest($path, $params = null)
    {
        $body = null;
        if($params != null){
            $body = json_encode($params);
        }

        $request = new Request(
            'POST', 
            $this->baseUrl . $path,
            [
                'Authorization' => 'App ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ], $body);

        $response = $this->guzzle->send($request);
        if($response->getStatusCode() == 200){
            return json_decode($response->getBody()->getContents());
        }

        return null;
    }

    protected function processConfig()
    {
        if(array_key_exists('api_key', $this->config)){
            $this->apiKey = $this->config['api_key'];
        }
        if(array_key_exists('base_url', $this->config)){
            $this->baseUrl = $this->config['base_url'];
        }
        if(array_key_exists('sender', $this->config)){
            $this->sender = $this->config['sender'];
        }
    }
}
