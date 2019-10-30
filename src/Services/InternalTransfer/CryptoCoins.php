<?php

namespace URPay\Services\InternalTransfer;

class CryptoCoins
{
    private $transactionHash;

    /**
     * Get the value of transactionHash
     */
    public function getTransactionHash()
    {
        return $this->transactionHash;
    }

    /**
     * Set the value of transactionHash
     *
     * @return  self
     */
    public function setTransactionHash($transactionHash)
    {
        $this->transactionHash = $transactionHash;

        return $this;
    }
}
