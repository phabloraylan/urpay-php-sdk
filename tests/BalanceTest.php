<?php

namespace Tests;

use URPay\Services\Balance\BalanceService;
use URPay\Client;

class BalanceTest extends TestCase
{
    public function testBalance()
    {
        $client = new Client();
        $client->setTokenCommon(getenv("TOKEN_COMMON"));

        $balanceResponse = BalanceService::getBalance($client);

        $this->assertEquals(getenv("BALANCE_VALUE"), $balanceResponse->getBalance());
    }
}
