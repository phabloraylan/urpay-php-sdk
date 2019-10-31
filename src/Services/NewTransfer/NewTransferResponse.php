<?php

namespace URPay\Services\NewTransfer;

use Carbon\Carbon;

class NewTransferResponse
{
    private $updated;
    private $id;
    private $sendFrom;
    private $sendTo;
    private $value;
    private $registered;
    private $registeredCarbon;

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
    public function setSendFrom($sendFrom)
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
    public function setSendTo($sendTo)
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
    public function setRegisteredCarbon($registeredCarbon)
    {
        $this->registeredCarbon = $registeredCarbon;

        return $this;
    }
}
