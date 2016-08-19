<?php

namespace SellerWorks\Amazon\Credentials;

/**
 * Interface for all classes that require the credentials object.
 */
interface CredentialsAwareInterface
{
    /**
     * Return credentials object.
     *
     * @return CredentialsInterface|null
     */
    function getCredentials();

    /**
     * Store credentials object.
     *
     * @param  CredentialsInterface  $credentials
     * @return self
     */
    function setCredentials(CredentialsInterface $credentials);
}