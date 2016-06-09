<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common;

/**
 * Amazon MWS Passport
 */
final class Passport
{
    /**
     * @var string
     */
    private $SellerId;

    /**
     * @var string
     */
    private $AccessKey;

    /**
     * @var string
     */
    private $SecretKey;

    /**
     * @var string
     */
    private $MwsAuthToken;

    /**
     * Value object constructor.
     *
     * @param  string $SellerId
     * @param  string $AccessKey
     * @param  string $SecretKey
     * @param  string $MwsAuthToken
     * @return void
     */
    public function __construct(
        string $SellerId,
        string $AccessKey,
        string $SecretKey,
        string $MwsAuthToken = ''
    )
    {
        $this->SellerId     = $SellerId;
        $this->AccessKey    = $AccessKey;
        $this->SecretKey    = $SecretKey;
        $this->MwsAuthToken = $MwsAuthToken;
    }

    /**
     * @return string
     */
    public function getSellerId(): string
    {
        return $this->SellerId;
    }

    /**
     * @return string
     */
    public function getAccessKey(): string
    {
        return $this->AccessKey;
    }

    /**
     * @return string
     */
    public function getSecretKey(): string
    {
        return $this->SecretKey;
    }

    /**
     * @return string
     */
    public function getMwsAuthToken(): string
    {
        return $this->MwsAuthToken;
    }
}