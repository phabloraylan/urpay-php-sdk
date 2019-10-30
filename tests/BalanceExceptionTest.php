<?php

namespace Tests;

use URPay\Services\Balance\BalanceService;
use URPay\Client;
use URPay\Exceptions\URPayTokenException;

class BalanceExceptionTest extends TestCase
{
    public function testBalanceTokenException()
    {
        $this->expectException(URPayTokenException::class);
        $client = new Client();
        $client->setTokenCommon("invalid_token");

        $balanceResponse = BalanceService::getBalance($client);
    }
}
