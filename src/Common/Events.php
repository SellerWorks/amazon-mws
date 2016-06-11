<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common;

/**
 * Event names.
 */
final class Events
{
    const REQUEST   = 'amazon.mws.request';
    const RESPONSE  = 'amazon.mws.response';
    const EXCEPTION = 'amazon.mws.exception';
}