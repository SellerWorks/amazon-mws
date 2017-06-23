<?php

namespace SellerWorks\Amazon\Credentials;

use Serializable;

/**
 * Amazon MWS Credentials value object.
 */
final class Credentials implements CredentialsInterface, Serializable
{
    /** @var string */
    private $sellerId;

    /** @var string */
    private $accessKey;

    /** @var string */
    private $secretKey;

    /** @var string */
    private $mwsAuthToken;

    /**
     * @param  string $sellerId
     * @param  string $accessKey
     * @param  string $secretKey
     * @param  string $mwsAuthToken
     */
    public function __construct(
        string $sellerId,
        string $accessKey,
        string $secretKey,
        string $mwsAuthToken = '',
        string $country = 'us'
    ) {
        $this->sellerId     = trim($sellerId);
        $this->accessKey    = trim($accessKey);
        $this->secretKey    = trim($secretKey);
        $this->mwsAuthToken = trim($mwsAuthToken);
    }

    /**
     * @return string
     */
    public function getSellerId(): string
    {
        return $this->sellerId;
    }

    /**
     * @return string
     */
    public function getAccessKey(): string
    {
        return $this->accessKey;
    }

    /**
     * @return string
     */
    public function getSecretKey(): string
    {
        return $this->secretKey;
    }

    /**
     * @return string
     */
    public function getMwsAuthToken(): string
    {
        return $this->mwsAuthToken;
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return serialize([
            $this->sellerId,
            $this->accessKey,
            $this->secretKey,
            $this->mwsAuthToken,
        ]);
    }

    /**
     * @return array
     */
    public function unserialize($serialized)
    {
        list(
            $this->sellerId,
            $this->accessKey,
            $this->secretKey,
            $this->mwsAuthToken
        ) = unserialize($serialized);
    }
}
