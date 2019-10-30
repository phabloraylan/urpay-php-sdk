<?php

namespace Tests;

use URPay\Client;
use URPay\Services\User\UserService;
use URPay\Exceptions\URPaySDKException;

class UserSDKExceptionTest extends TestCase
{

    public function testGetUserSDKException()
    {

        $this->expectException(URPaySDKException::class);

        $client = new Client();
        $client->setTokenCommon(getenv("TOKEN_COMMON"));

        $user_id = "";
        $userResponse = UserService::getUser($client, $user_id);
    }
}
