<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common;

/**
 * Amazon MWS Passport
 *
 * @author      Steve Nebes
 * @copyright   Copyright (c) 2016 SellerWorks (https://seller.works)
 */
final class Passport
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