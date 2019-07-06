<?php
namespace URPay;

class Consulta {

    private $cliente;
    public function __construct($cliente){
        $this->cliente = $cliente;
    }

    public function getUsuario($id){
        
        $token = $this->cliente->getTokenComum();
        // Create a client with a base URI
        $client = new \GuzzleHttp\Client(['base_uri' => Http\Api::URL_BASE,'verify' => false]);
        // Send a request to https://foo.com/api/test
        $response = $client->request('GET', '/v1/user-api/' . $id, [
            'headers' => [
                'Authorization' => $token
            ]
        ]);
        $body = json_decode($response->getBody(),true)['user'];
        return $body;
    }

    public function getTransferencia($id){
        
        $token = $this->cliente->getTokenComum();
        // Create a client with a base URI
        $client = new \GuzzleHttp\Client(['base_uri' => Http\Api::URL_BASE,'verify' => false]);
        // Send a request to https://foo.com/api/test
        $response = $client->request('GET', '/v1/user-api/internal-transfer/' . $id, [
            'headers' => [
                'Authorization' => $token
            ]
        ]);
        $body = json_decode($response->getBody(),true)['transfer'];
        return $body;
    }
}