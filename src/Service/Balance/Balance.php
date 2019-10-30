<?php

namespace URPay\Bean;

class Balance
{
    private $balance;
    private $blocked;
    private $future;
    private $giftcard;

    /**
     * Get the value of balance
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set the value of balance
     *
     * @return  self
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get the value of blocked
     */
    public function getBlocked()
    {
        return $this->blocked;
    }

    /**
     * Set the value of blocked
     *
     * @return  self
     */
    public function setBlocked($blocked)
    {
        $this->blocked = $blocked;

        return $this;
    }

    /**
     * Get the value of future
     */
    public function getFuture()
    {
        return $this->future;
    }

    /**
     * Set the value of future
     *
     * @return  self
     */
    public function setFuture($future)
    {
        $this->future = $future;

        return $this;
    }

    /**
     * Get the value of giftcard
     */ 
    public function getGiftcard()
    {
        return $this->giftcard;
    }

    /**
     * Set the value of giftcard
     *
     * @return  self
     */ 
    public function setGiftcard($giftcard)
    {
        $this->giftcard = $giftcard;

        return $this;
    }
}
