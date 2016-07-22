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
     * @var string
     */
    protected $Region;

    /**
     * @param  string  $SellerId
     * @param  string  $AccessKey
     * @param  string  $SecretKey
     * @param  string  $MwsAuthToken
     * @param  string  $Region
     */
    public function __construct(
        string $SellerId,
        string $AccessKey,
        string $SecretKey,
        string $MwsAuthToken = '',
        string $Region = Region::US
    )
    {
        $this->SellerId     = $SellerId;
        $this->AccessKey    = $AccessKey;
        $this->SecretKey    = $SecretKey;
        $this->MwsAuthToken = $MwsAuthToken;
        $this->Region       = $Region;
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

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->Region;
    }
}
