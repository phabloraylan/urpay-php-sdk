<?php

namespace URPay\Http;

use URPay\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\RequestException;

abstract class Api
{
    const URL_API = 'https://api.urpay.com.br';
    const GET = 'GET';
    const POST = 'POST';

    private static $client;

    private function __construct()
    { }

    public static function getClientRest()
    {

        if (!isset(self::$client)) {
            self::$client = new \GuzzleHttp\Client(['base_uri' => self::URL_API]);
        }

        return self::$client;
    }

    public static function fromJson(Response $response)
    {
        $arr = \json_decode($response->getBody(), true);
        return $arr;
    }

    public static function getErrorMessage(RequestException $clientException)
    {
        $response = $clientException->getResponse();
        $arr = self::fromJson($response);

        return $arr['message']['message'];
    }

}
