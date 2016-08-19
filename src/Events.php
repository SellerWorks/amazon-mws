<?php

namespace SellerWorks\Amazon;

/**
 * Event enumorations for events dispatched using Symfony EventDispatcher.
 *
 */
final class Events
{
    const REQUEST   = 'sellerworks.amazon.request';
    const RESPONSE  = 'sellerworks.amazon.response';
    const EXCEPTION = 'sellerworks.amazon.exception';
}