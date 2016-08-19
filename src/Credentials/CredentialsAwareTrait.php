<?php

namespace SellerWorks\Amazon\Credentials;

/**
 * Trait used in conjunction with the CredentialsAwareInterface.
 */
trait CredentialsAwareTrait
{
    /**
     * @var CredentialsInterface
     */
    protected $credentials;

    /**
     * Return credentials object.
     *
     * @return CredentialsInterface|null
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * Store credentials object.
     *
     * @param  CredentialsInterface  $credentials
     * @return self
     */
    public function setCredentials(CredentialsInterface $credentials)
    {
        $this->credentials = $credentials;

        return $this;
    }
}