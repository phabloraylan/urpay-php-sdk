<?php

namespace Tests;

use URPay\Client;
use URPay\Services\User\UserService;


class UserDocTest extends TestCase
{
    public function testGetUser()
    {
        $client = new Client();
        $client->setTokenDoc(getenv("TOKEN_DOC"));

        $user_id = getenv("USER_DOC");
        $userResponse = UserService::getUser($client, $user_id,true);

        $this->assertEquals($userResponse->getEmail(),"phabloraylan@gmail.com");
    }

}
