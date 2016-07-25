<?php

namespace SellerWorks\Amazon\Credentials;

/**
 * Credentials for all requests.
 */
final class Credentials implements CredentialsInterface
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
     * @param  string  $AccessKey
     * @param  string  $SecretKey
     * @param  string  $MwsAuthToken
     */
    public function __construct(string $SellerId, string $AccessKey, string $SecretKey, string $MwsAuthToken = '')
    {
        $this->SellerId     = trim($SellerId);
        $this->AccessKey    = trim($AccessKey);
        $this->SecretKey    = trim($SecretKey);
        $this->MwsAuthToken = trim($MwsAuthToken);
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
