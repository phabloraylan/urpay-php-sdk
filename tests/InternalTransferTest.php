<?php

namespace Tests;

use URPay\Services\InternalTransfer\InternalTransferService;
use URPay\Client;

class InternalTransferTest extends TestCase
{
    public function testInternalTransfer()
    {
        $client = new Client();
        $client->setTokenCommon(getenv("TOKEN_COMMON"));

        $transf = getenv("INTERNAL_TRANSFER_HASH");
        $transfResponse = InternalTransferService::getInternalTransfer($client, $transf);

        $this->assertEquals(getenv("INTERNAL_TRANSFER_VALUE"), $transfResponse->getValue());
    }

    public function testInternalTransferCarbon()
    {
        $client = new Client();
        $client->setTokenCommon(getenv("TOKEN_COMMON"));

        $transf = getenv("INTERNAL_TRANSFER_HASH");
        $transfResponse = InternalTransferService::getInternalTransfer($client, $transf);
        $carbon = $transfResponse->getRegisteredCarbon();
         
        $this->assertEquals(getenv("INTERNAL_TRANSFER_YEAR"), $carbon->year);
    }
}
