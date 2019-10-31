<?php

namespace URPay\Services\InternalTransfer;

use URPay\Services\User\User;
use Carbon\Carbon;

class InternalTransfer
{

    private $cryptoCoins;
    private $updated;
    private $payment;
    private $status;
    private $contested;
    private $reversed;
    private $reversal;
    private $isCryptoCoins;
    private $id;
    private $sendFrom;
    private $sendTo;
    private $value;
    private $registered;
    private $registeredCarbon;


    /**
     * Get the value of cryptoCoins
     */
    public function getCryptoCoins()
    {
        return $this->cryptoCoins;
    }

    /**
     * Set the value of cryptoCoins
     *
     * @return  self
     */
    public function setCryptoCoins(CryptoCoins $cryptoCoins)
    {
        $this->cryptoCoins = $cryptoCoins;

        return $this;
    }

    /**
     * Get the value of updated
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set the value of updated
     *
     * @return  self
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get the value of payment
     */
    public function isPayment()
    {
        return $this->payment;
    }

    /**
     * Set the value of payment
     *
     * @return  self
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of contested
     */
    public function getContested()
    {
        return $this->contested;
    }

    /**
     * Set the value of contested
     *
     * @return  self
     */
    public function setContested($contested)
    {
        $this->contested = $contested;

        return $this;
    }

    /**
     * Get the value of reversed
     */
    public function isReversed()
    {
        return $this->reversed;
    }

    /**
     * Set the value of reversed
     *
     * @return  self
     */
    public function setReversed($reversed)
    {
        $this->reversed = $reversed;

        return $this;
    }

    /**
     * Get the value of reversal
     */
    public function isReversal()
    {
        return $this->reversal;
    }

    /**
     * Set the value of reversal
     *
     * @return  self
     */
    public function setReversal($reversal)
    {
        $this->reversal = $reversal;

        return $this;
    }

    /**
     * Get the value of isCryptoCoins
     */
    public function getIsCryptoCoins()
    {
        return $this->isCryptoCoins;
    }

    /**
     * Set the value of isCryptoCoins
     *
     * @return  self
     */
    public function setIsCryptoCoins($isCryptoCoins)
    {
        $this->isCryptoCoins = $isCryptoCoins;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of sendFrom
     */
    public function getSendFrom()
    {
        return $this->sendFrom;
    }

    /**
     * Set the value of sendFrom
     *
     * @return  self
     */
    public function setSendFrom(User $sendFrom)
    {
        $this->sendFrom = $sendFrom;

        return $this;
    }

    /**
     * Get the value of sendTo
     */
    public function getSendTo()
    {
        return $this->sendTo;
    }

    /**
     * Set the value of sendTo
     *
     * @return  self
     */
    public function setSendTo(User $sendTo)
    {
        $this->sendTo = $sendTo;

        return $this;
    }

    /**
     * Get the value of value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of value
     *
     * @return  self
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get the value of registered
     */
    public function getRegistered()
    {
        return $this->registered;
    }

    /**
     * Set the value of registered
     *
     * @return  self
     */
    public function setRegistered($registered)
    {
        $this->registered = $registered;

        return $this;
    }

    /**
     * Get the value of registeredCarbon
     */ 
    public function getRegisteredCarbon()
    {
        $this->registeredCarbon = new Carbon($this->getRegistered());
        return $this->registeredCarbon;
    }

    /**
     * Set the value of registeredCarbon
     *
     * @return  self
     */ 
    public function setRegisteredCarbon(Carbon $registeredCarbon)
    {
        $this->registeredCarbon = $registeredCarbon;

        return $this;
    }
}
