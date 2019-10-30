<?php

namespace URPay\Services\InternalTransfer;

use GuzzleHttp\Exception\ClientException;
use URPay\Client;
use URPay\Http\Api;
use URPay\Http\Endpoint;
use GuzzleHttp\Exception\ServerException;
use URPay\Exceptions\URPayResponseException;
use URPay\Exceptions\URPayTokenException;
use URPay\Utils\MoneyUtil;
use URPay\Services\User\User;
use URPay\Services\User\Document;

class InternalTransferService extends Api
{

    private static $transfer;

    private function __construct()
    { }

    public static function getInternalTransfer(Client $client)
    {
        if (!isset(self::$transfer)) {

            $response = self::getResponse($client);
            $arr = self::fromJson($response)['transfer'];

            self::$transfer = new InternalTransfer();
            
            $cryptoCoins = new CryptoCoins();
            $cryptoCoins->setTransactionHash($arr['crypto_coins']['transaction_hash']);
            
            self::$transfer->setCryptoCoins($cryptoCoins);

            self::$transfer->setUpdated($arr['updated']);
            self::$transfer->setPayment($arr['is_payment']);
            self::$transfer->setStatus($arr['status']);
            self::$transfer->setContested($arr['is_contested']);
            self::$transfer->setReversed($arr['is_reversed']);
            self::$transfer->setReversal($arr['is_reversal']);
            self::$transfer->setIsCryptoCoins($arr['is_crypto_coins']);
            self::$transfer->setId($arr['_id']);

            $sendFrom = new User();
            $sendFrom->setId($arr['send_from']['_id']);
            $sendFrom->setUser($arr['send_from']['user']);
            $sendFrom->setName($arr['send_from']['name']);

            $document = new Document();
            $document->setDocument($arr['send_from']['document']['document']);
            $document->setType($arr['send_from']['document']['type']);
            $sendFrom->setDocument($document);
            self::$transfer->setSendFrom($sendFrom);

            $sendTo = new User();
            $sendTo->setId($arr['send_to']['_id']);
            $sendTo->setUser($arr['send_to']['user']);
            $sendTo->setName($arr['send_to']['name']);

            $document = new Document();
            $document->setDocument($arr['send_to']['document']['document']);
            $document->setType($arr['send_to']['document']['type']);
            $sendTo->setDocument($document);
            self::$transfer->setSendTo($sendTo);

            self::$transfer->setValue(MoneyUtil::convertIntToDecimal($arr['value']));
            self::$transfer->setRegistered($arr['registered']);

        }

        return self::$transfer;
    }

    public static function getResponse(Client $client)
    {
        try {
            $clientRest = self::getClientRest();

            $response = $clientRest->request(self::GET, Endpoint::INTERNAL_TRANSFER, [
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
