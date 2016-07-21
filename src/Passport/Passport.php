<?php

namespace SellerWorks\Amazon\Passport;

/**
 * Passport for all requests.
 */
final class Passport implements PassportInterface
{
    /**
     * @var string
     */
    protected $SellerId;

    /**
     * @var string
     */
    protected $AccessKey;

    /**
     * @var string
     */
    protected $SecretKey;

    /**
     * @var string
     */
    protected $MwsAuthToken;

    /**
     * @param  string  $SellerId
     * @param  string  $SellerId
     * @param  string  $SellerId
     * @param  string  $SellerId
     */
    public function __construct(string $SellerId, string $AccessKey, string $SecretKey, string $MwsAuthToken = '')
    {
        $this->SellerId     = $SellerId;
        $this->AccessKey    = $AccessKey;
        $this->SecretKey    = $SecretKey;
        $this->MwsAuthToken = $MwsAuthToken;
    }

    /**
     * @return string
     */
    public function getSellerId()
    {
        return $this->SellerId;
    }

    /**
     * @return string
     */
    public function getAccessKey()
    {
        return $this->AccessKey;
    }

    /**
     * @return string
     */
    public function getSecretKey()
    {
        return $this->SecretKey;
    }

    /**
     * @return string
     */
    public function getMwsAuthToken()
    {
        return $this->MwsAuthToken;
    }
}