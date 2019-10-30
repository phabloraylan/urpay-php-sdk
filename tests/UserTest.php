<?php

namespace Tests;

use URPay\Client;
use URPay\Services\User\UserService;


class UserTest extends TestCase
{
    public function testGetUser()
    {
        $client = new Client();
        $client->setTokenCommon(getenv("TOKEN_COMMON"));

        $user_id = getenv("USER_ID");
        $userResponse = UserService::getUser($client, $user_id);

        $this->assertEquals($userResponse->getUser(), $user_id);
    }

    public function testGetUserWithArroba()
    {
        $client = new Client();
        $client->setTokenCommon(getenv("TOKEN_COMMON"));

        $user_id = getenv("USER_ID");
        $user_id_arroba = "@" . getenv("USER_ID");
        $userResponse = UserService::getUser($client, $user_id_arroba);

        $this->assertEquals($userResponse->getUser(), $user_id);
    }
}
