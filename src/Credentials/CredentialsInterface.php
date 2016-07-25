<?php

namespace SellerWorks\Amazon\Credentials;

/**
 * Credentials interface.
 */
namespace CredentialsInterface
{
    /**
     * Get Seller Id.
     *
     * @return string
     */
    function getSellerId();

    /**
     * Get Access Key.
     *
     * @return string
     */
    function getAccessKey();

    /**
     * Get Secret Access Key.
     *
     * @return string
     */
    function getSecretKey();

    /**
     * Get MWS Auth Token.
     *
     * @return string
     */
    function getMwsAuthToken();
}