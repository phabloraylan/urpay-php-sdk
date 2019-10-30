<?php

namespace URPay;

use URPay\Exceptions\URPaySDKException;

/**
 * Class Client
 *
 * @package URPay
 */
class Client
{
    private $tokenCommon;
    private $tokenTransfer;
    private $tokenConfig;

    /**
     * Get the value of tokenCommon
     */
    public function getTokenCommon()
    {
        return $this->tokenCommon;
    }

    /**
     * Set the value of tokenCommon
     *
     * @return  self
     */
    public function setTokenCommon($tokenCommon)
    {
        $this->tokenCommon = $tokenCommon;

        return $this;
    }

    /**
     * Get the value of tokenTransfer
     */
    public function getTokenTransfer()
    {
        return $this->tokenTransfer;
    }

    /**
     * Set the value of tokenTransfer
     *
     * @return  self
     */
    public function setTokenTransfer($tokenTransfer)
    {
        $this->tokenTransfer = $tokenTransfer;

        return $this;
    }

    /**
     * Get the value of tokenConfig
     */
    public function getTokenConfig()
    {
        return $this->tokenConfig;
    }

    /**
     * Set the value of tokenConfig
     *
     * @return  self
     */
    public function setTokenConfig($file)
    {

        if (!file_exists($file)) {
            throw new URPaySDKException("O arquivo de configuração não existe no caminho " . $file, 500);
        }

        $json = file_get_contents($file);

        if (!$file = json_decode($json, true)) {
            throw new URPaySDKException('O arquivo de configuração possui json inválido');
        }

        if (!isset($file['common']) && !isset($file['transfer'])) {
            throw new URPaySDKException('O arquivo de configuração deve conter os campos common e transfer');
        }

        $this->tokenCommon = $file['common'];
        $this->tokenTransfer = $file['transfer'];
    }

    public function useApplicationDefaultTokens()
    {
        $file = getenv("URPAY_APPLICATION_TOKENS");
        $this->setTokenConfig($file);
    }
}
