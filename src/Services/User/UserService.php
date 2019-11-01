<?php

namespace URPay\Services\User;

use GuzzleHttp\Exception\ClientException;
use URPay\Client;
use URPay\Http\Api;
use URPay\Http\Endpoint;
use GuzzleHttp\Exception\ServerException;
use URPay\Exceptions\URPayResponseException;
use URPay\Exceptions\URPayTokenException;
use URPay\Exceptions\URPaySDKException;
use \HashtagOrArrobaRemover\HashtagOrArrobaRemover;
use JansenFelipe\Utils\Utils as Utils;
use JansenFelipe\Utils\Mask as Mask;

class UserService extends Api
{

    private static $user;
    const DOCUMENT = true;

    private function __construct()
    { }

    public static function getUser(Client $client, $user_id, $doc = false)
    {

        if ($user_id == null || empty($user_id)) {
            throw new URPaySDKException("O usuário não pode está vazio", 422);
        }

        if (!isset(self::$user)) {

            $response = self::getResponse($client, $user_id, $doc);
            $arr = self::fromJson($response)['user'];

            self::$user = new User();
            self::$user->setGender($arr['gender']);
            self::$user->setId($arr['_id']);
            self::$user->setUser($arr['user']);
            self::$user->setName($arr['name']);

            if ($doc) {
                self::$user->setEmail($arr['email']['email']);
            }

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

    public static function getResponse(Client $client, $user_id, $doc = false)
    {

        try {
            $clientRest = self::getClientRest();

            if ($doc) {

                $user_id = Utils::unmask($user_id, Mask::DOCUMENTO); 
                $response = $clientRest->request(self::GET, Endpoint::USER_DOC . '/' . $user_id, [
                    'headers' => [
                        'Authorization' => $client->getTokenDoc()
                    ]
                ]);
            } else {
                $user_id = HashtagOrArrobaRemover::toRemoveSymbol($user_id);
                $response = $clientRest->request(self::GET, Endpoint::USER . '/' . $user_id, [
                    'headers' => [
                        'Authorization' => $client->getTokenCommon()
                    ]
                ]);
            }
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
