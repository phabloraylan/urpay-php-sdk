<?php

namespace URPay\Services\Balance;

use URPay\Client;
use URPay\Http\Api;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use URPay\Exceptions\URPayTokenException;

class BalanceService extends Api
{

    private static $balance;

    private function __construct()
    { }

    public static function getBalance(Client $client)
    {
        if (!isset(self::$balance)) {

            try {

                $response = self::getResponse($client);
                $arr = self::fromJson($response)['balance'];

                self::$balance = new Balance();
                self::$balance->setBalance($arr['balance']);
                self::$balance->setBlocked($arr['balance_blocked']);
                self::$balance->setFuture($arr['balance_future']);
                self::$balance->setGiftcard($arr['balance_giftcard']);
            } catch (RequestException $e) {

                if ($e->getStatusCode() == 401) {
                    $message = self::getErrorMessage($e);
                    throw new URPayTokenException($message, $e->getStatusCode());
                }

                throw new URPayServerException($e->getMessage(), $e->getStatusCode());
            }
        }

        return self::$balance;
    }

    public static function getResponse(Client $client)
    {
        $clientRest = self::getClientRest();

        $response = $clientRest->request(self::GET, 'v1/user-api/balance', [
            'headers' => [
                'Authorization' => $client->getTokenCommon()
            ]
        ]);

        return $response;
    }
}
