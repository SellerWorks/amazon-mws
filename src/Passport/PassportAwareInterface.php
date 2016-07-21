<?php

namespace SellerWorks\Amazon\Passport;

/**
 * Interface for all classes that require the passport object.
 */
interface PassportAwareInterface
{
    /**
     * Return passport object.
     *
     * @return PassportInterface|null
     */
    function getPassport();

    /**
     * Store passport object.
     *
     * @param  PassportInterface  $passport
     * @return self
     */
    function setPassport(PassportInterface $passport);
}