<?php

namespace AnalogBridge;

use GuzzleHttp\Client;

class AnalogBridge
{

    public $apiKey;

    public $apiBase = 'https://api.analogbridge.io';

    public $apiVersion = null;

    const VERSION = '1.0.0';

    protected $client;

    protected $data;

    protected $message;

    protected $errors;

    protected $status;

    protected $keyRequired = true;

    public function __construct($apiKey = null)
    {
        if($this->keyRequired)
        {
            $this->setApiKey($apiKey);
            $this->validate();
        }

        $this->newHttpClient();
        $this->setApiVersion('v1');
    }

    public function validate()
    {
        if(!$this->apiKey)
        {
            throw new \Exception("Bridge API Secret Key Required");
        }
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getApiVersion()
    {
        if(!$this->apiVersion)
        {
            return 'v1';
        }
        return $this->apiVersion;
    }

    public function setApiVersion($apiVersion)
    {
        $this->apiVersion = $apiVersion;
    }


    public function request($method, $url, $params = null, $headers = null)
    {
        if (!$params) {
            $params = [];
        }
        if (!$headers) {
            $headers = [];
        }


        $request = $this->client->createRequest($method, $this->apiUrl($url), [
            'body' => $params,
            'auth' => [$this->getApiKey(), ''],
            'exceptions' => false
        ]);

        $response = $this->client->send($request);

        return $this->process_response($response);

    }

    public function newHttpClient()
    {
        $this->client = new Client();
    }

    public function apiUrl($url)
    {
        return $this->apiBase . '/' . $this->getApiVersion() . '/' . $url;
    }

    private function process_response($r)
    {
        $this->status = $r->getStatusCode();

        if($this->status < 200 || $this->status >= 300)
        {
            $this->message = $r->getBody()->getContents();
            throw new \Exception($this->message);
        }

        $responseBodyContent = $r->getBody()->getContents();
        $responseBodyContent = json_decode($responseBodyContent);

        $this->message = isset($responseBodyContent->message) ? $responseBodyContent->message : null;
        $this->data = isset($responseBodyContent->data) ? $responseBodyContent->data : $responseBodyContent;

        return $this->data;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getData()
    {
        return $this->data;
    }
}