<?php

namespace URPay\Services\User;

use GuzzleHttp\Exception\ClientException;
use URPay\Client;
use URPay\Http\Api;
use URPay\Http\Endpoint;
use GuzzleHttp\Exception\ServerException;
use URPay\Exceptions\URPayResponseException;
use URPay\Exceptions\URPayTokenException;
use \HashtagOrArrobaRemover\HashtagOrArrobaRemover;

class UserService extends Api
{

    private static $user;

    private function __construct()
    { }

    public static function getUser(Client $client, $user_id)
    {
        if (!isset(self::$user)) {

            $response = self::getResponse($client, $user_id);
            $arr = self::fromJson($response)['user'];

            self::$user = new User();
            self::$user->setGender($arr['gender']);
            self::$user->setId($arr['_id']);
            self::$user->setUser($arr['user']);
            self::$user->setName($arr['name']);

            $document = new Document();
            $document->setDocument($arr['document']['document']);
            $document->setType($arr['document']['type']);

            self::$user->setDocument($document);

            $address = new Address();
            $address->setCity($arr['address']['city']);
            $address->setState($arr['address']['state']);
            $address->setCountry($arr['address']['country']);

            self::$user->setAddress($address);
        }

        return self::$user;
    }

    public static function getResponse(Client $client, $user_id)
    {
        try {
            $clientRest = self::getClientRest();
            $user_id = HashtagOrArrobaRemover::toRemoveSymbol($user_id);
            $response = $clientRest->request(self::GET, Endpoint::USER . '/' . $user_id, [
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
