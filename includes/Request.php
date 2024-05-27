<?php

require_once('RequestMethod.php');

class Request {
    private string $endpoint;

    private $json = [];

    private CurlHandle $curl;

    public function __construct(string $endpoint) {
        $this->endpoint = $endpoint;
    }

    public function getJson() {
        return $this->json;
    }

    public function get() {
        $this->initRequest(RequestMethod::GET, null, ['Content-Type: application/json']);
        $this->executeRequest();
    }

    private function initRequest(RequestMethod $method, array $data = null, array $headers = null) {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $this->endpoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $curlMethod = CURLOPT_HTTPGET;
        $curlMethodValue = true;
        switch($method) {
            case RequestMethod::POST:
                $curlMethod = CURLOPT_POST;
                break;
            case RequestMethod::PUT:
                $curlMethod = CURLOPT_PUT;
                break;
            case RequestMethod::DELETE:
                $curlMethod = CURLOPT_CUSTOMREQUEST;
                $curlMethodValue = 'DELETE';
                break;
        }

        curl_setopt($curl, $curlMethod, $curlMethodValue);

        if ($data) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        }

        if ($headers) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }

        $this->curl = $curl;
    }

    private function executeRequest() {
        $response = curl_exec($this->curl);
        if (curl_errno($this->curl)) {
            echo(curl_error($this->curl));
        }

        $this->json = json_decode($response, true);
        curl_close($this->curl);
        
        if (!is_array($this->json)) {
            echo("\n" . $response . "\n");
            $this->json = null;

            return;
        }
        
        if (key_exists('error', $this->json)) {
            echo("\n" . $this->json['error'] . "\n");
            $this->json = null;
        }
    }
}