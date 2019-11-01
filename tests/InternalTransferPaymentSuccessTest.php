<?php

namespace Tests;

use URPay\Services\InternalTransfer\InternalTransferService;
use URPay\Client;

class InternalTransferPaymentSuccessTest extends TestCase
{
    public function testInternalTransferSuccess()
    {
        $client = new Client();
        $client->setTokenCommon(getenv("TOKEN_COMMON"));

        $transf = getenv("INTERNAL_TRANSFER_HASH");
        $transfResponse = InternalTransferService::getInternalTransfer($client, $transf);

        $this->assertTrue($transfResponse->isPaymentSuccess());
    }
}