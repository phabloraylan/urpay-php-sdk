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

    public function testTokenConfigFileNotExistsException()
    {
        $this->expectException(URPaySDKException::class);
        $client = new Client();
        $file = __DIR__ . "/files/urpay_token.json";
        $client->setTokenConfig($file);
    }


    public function testTokenConfigJsonInvalidException()
    {
        $this->expectException(URPaySDKException::class);
        $client = new Client();

        $file = __DIR__ . "/files/urpay_tokens_invalid.json";
        $client->setTokenConfig($file);
    }

    public function testTokenConfigFileNotExistFieldsException()
    {
        $this->expectException(URPaySDKException::class);
        $client = new Client();

        $file = __DIR__ . "/files/urpay_tokens_fields_invalid.json";
        $client->setTokenConfig($file);
    }

    public function testUseApplicationDefaultTokens()
    {
        putenv('URPAY_APPLICATION_TOKENS=' . __DIR__ . "/files/urpay_tokens.json");
        $client = new Client();
        $client->useApplicationDefaultTokens();

        $this->assertEquals("token-common", $client->getTokenCommon());
    }
}
