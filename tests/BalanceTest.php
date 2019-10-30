<?php

namespace Tests;

use URPay\Services\Balance\BalanceService;
use URPay\Client;
use URPay\Exceptions\URPayTokenException;

class BalanceTest extends TestCase
{
    public function testBalance()
    {
        $client = new Client();
        $client->setTokenCommon(getenv("TOKEN_COMMON"));

        $balanceResponse = BalanceService::getBalance($client);

        $this->assertEquals("115320", $balanceResponse->getBalance());
        $this->assertEquals("0", $balanceResponse->getBlocked());
        $this->assertEquals("0", $balanceResponse->getFuture());
        $this->assertEquals("0", $balanceResponse->getGiftcard());
    }

    public function testBalanceTokenException()
    {
        $this->expectException(URPayTokenException::class);

        $client = new Client();
        $client->setTokenCommon(getenv("TOKEN_COMMO"));

        $balanceResponse = BalanceService::getBalance($client);

    }

}
