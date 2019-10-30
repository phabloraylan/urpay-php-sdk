<?php

namespace Tests;

use URPay\Client;
use URPay\Exceptions\URPaySDKException;

class ClientTest extends TestCase
{
    public function testTokenConfigFileExists()
    {
        $file = __DIR__ . "/files/urpay_tokens.json";
        $this->assertFileExists($file);
    }

    public function testTokenConfigSDKException()
    {
        $this->expectException(URPaySDKException::class);
        $client = new Client();
        $file = __DIR__ . "/files/urpay_tokens.json";
        $client->setTokenConfig($file);

        $file = __DIR__ . "/files/urpay_tokens_invalid.json";
        $client->setTokenConfig($file);
    }
}
