<?php

namespace SellerWorks\Amazon\Credentials;

/**
 * Amazon MWS Credentials interface.
 */
interface CredentialsInterface
{
    /**
     * Get Seller Id.
     *
     * @return string
     */
    public function getSellerId(): string;

    /**
     * Get Access Key.
     *
     * @return string
     */
    public function getAccessKey(): string;

    /**
     * Get Secret Access Key.
     *
     * @return string
     */
    public function getSecretKey(): string;

    /**
     * Get MWS Auth Token.
     *
     * @return string
     */
    public function getMwsAuthToken(): string;
}