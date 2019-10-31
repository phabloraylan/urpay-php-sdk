<?php

namespace URPay\Services\NewTransfer;

use URPay\Client;
use URPay\Utils\MoneyUtil;

class NewTransferService
{
    public function execute(Client $client, NewTransfer $newTransfer)
    {
        try {
            $clientRest = self::getClientRest();

            $response = $clientRest->request(self::POST, Endpoint::NEW_TRANSFER, [
                'headers' => [
                    'Authorization' => $client->getTokenCommon()
                ],
                'json' => [
                    'to_user_id' => $newTransfer->getId(),
                    'value' => MoneyUtil::convertDecimalToInt($newTransfer->getValue())
                ]
            ]);

            $arr = self::fromJson($response)['transfer'];

            $newTransferResponse = new NewTransferResponse();
            $newTransferResponse->setUpdated($arr['updated']);
            $newTransferResponse->setId($arr['_id']);
            $newTransferResponse->setSendFrom($arr['send_from']);
            $newTransferResponse->setSendTo($arr['send_to']);
            $newTransferResponse->setValue(MoneyUtil::convertIntToDecimal($arr['value']));
            $newTransferResponse->setRegistered($arr['registered']);

            return $newTransferResponse;
        } catch (ClientException $e) {

            if ($e->getCode() == 401) {
                throw new URPayTokenException(self::getErrorMessage($e), $e->getCode());
            }

            throw new URPayResponseException(self::getErrorMessage($e), $e->getCode());
        } catch (ServerException $e) {
            throw new URPayServerException("Erro no servidor da URPay", $e->getCode());
        }
    }
}
