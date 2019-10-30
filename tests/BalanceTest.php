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

        $this->assertEquals("1153.20", $balanceResponse->getBalance());
        $this->assertEquals("0", $balanceResponse->getBlocked());
        $this->assertEquals("0", $balanceResponse->getFuture());
        $this->assertEquals("0", $balanceResponse->getGiftcard());
    }
}
