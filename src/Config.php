<?php

namespace SellerWorks\Amazon\MWS;

/**
 * Amazon MWS API Config
 *
 * @author      Steve Nebes
 * @copyright   Copyright (c) 2016 SellerWorks (https://seller.works)
 */
final class Config
{
    private $sellerId;
    private $accessKey;
    private $secretKey;
    private $mwsAuthToken;

    public function __construct(
        string $sellerId,
        string $accessKey,
        string $secretKey,
        string $mwsAuthToken = null
    )
    {
        $this->sellerId     = $sellerId;
        $this->accessKey    = $accessKey;
        $this->secretKey    = $secretKey;
        $this->mwsAuthToken = $mwsAuthToken;
    }

    public function getSellerId(): string
    {
        return $this->sellerId;
    }

    public function getAccessKey(): string
    {
        return $this->accessKey;
    }

    public function getSecretKey(): string
    {
        return $this->secretKey;
    }

    public function getMwsAuthToken(): string
    {
        return $this->mwsAuthToken;
    }
}