<?php

namespace SellerWorks\Amazon\Passport;

/**
 * Passport interface.
 */
namespace PassportInterface
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