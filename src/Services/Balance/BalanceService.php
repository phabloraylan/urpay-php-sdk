<?php

namespace URPay\Services\Balance;

use GuzzleHttp\Exception\ClientException;
use URPay\Client;
use URPay\Http\Api;
use URPay\Http\Endpoint;
use GuzzleHttp\Exception\ServerException;
use URPay\Exceptions\URPayResponseException;
use URPay\Exceptions\URPayTokenException;

class BalanceService extends Api
{

    private static $balance;

    private function __construct()
    { }

    public static function getBalance(Client $client)
    {
        if (!isset(self::$balance)) {

            $response = self::getResponse($client);
            $arr = self::fromJson($response)['balance'];

            self::$balance = new Balance();
            self::$balance->setBalance($arr['balance']);
            self::$balance->setBlocked($arr['balance_blocked']);
            self::$balance->setFuture($arr['balance_future']);
            self::$balance->setGiftcard($arr['balance_giftcard']);
        }

        return self::$balance;
    }

    public static function getResponse(Client $client)
    {
        try {
            $clientRest = self::getClientRest();

            $response = $clientRest->request(self::GET, Endpoint::BALANCE, [
                'headers' => [
                    'Authorization' => $client->getTokenCommon()
                ]
            ]);
        } catch (ClientException $e) {

            if ($e->getCode() == 401) {
                throw new URPayTokenException(self::getErrorMessage($e), $e->getCode());
            }

            throw new URPayResponseException(self::getErrorMessage($e), $e->getCode());
        } catch (ServerException $e) {
            throw new URPayServerException("Erro no servidor da URPay", $e->getCode());
        }

        return $response;
    }
}
