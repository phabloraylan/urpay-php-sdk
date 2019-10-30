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

        $user_id = "phabloraylan";
        $userResponse = UserService::getUser($client, $user_id);

        $this->assertEquals($userResponse->getUser(), $user_id);
        $this->assertEquals($userResponse->getDocument()->getDocument(), "01608508510");
    }

    public function testGetUserWithArroba()
    {
        $client = new Client();
        $client->setTokenCommon(getenv("TOKEN_COMMON"));

        $user_id = "phabloraylan";
        $user_id_arroba = "@phabloraylan";
        $userResponse = UserService::getUser($client, $user_id_arroba);

        $this->assertEquals($userResponse->getUser(), $user_id);
    }
}
