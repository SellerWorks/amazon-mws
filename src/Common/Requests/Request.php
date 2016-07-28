<?php

namespace SellerWorks\Amazon\Common\Requests;

use SellerWorks\Amazon\Common\RequestInterface;
// use SellerWorks\Amazon\Credentials\CredentialsAwareInterface;
// use SellerWorks\Amazon\Credentials\CredentialsAwareTrait;

/**
 * Base class for all Requests.
 */
abstract class Request implements RequestInterface // , CredentialsAwareInterface
{
    /**
     * @property $credentials
     *
     * @method  CredentialsInterface  getCredentials()
     * @method  self  setCredentials(CredentialsInterface $$credentials)
     */
//      use CredentialsAwareTrait;
}