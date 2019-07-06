<?php
namespace URPay;
class Cliente {

    private $token;
    public function setTokenComum($token){
        $this->token = $token;
    }

    public function getTokenComum(){
        return $this->token;
    }
}