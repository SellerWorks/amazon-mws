<?php

namespace SellerWorks\Amazon\Common\Requests;

use SellerWorks\Amazon\Common\RequestInterface;

/**
 * Base class for all Requests.
 */
abstract class Request implements RequestInterface // , PassportAwareInterface
{
    /**
     * @property $passport
     *
     * @method  PassportInterface  getPassport()
     * @method  self  setPassport(PassportInterface $passport)
     */
//     use PassportAwareTrait;
}