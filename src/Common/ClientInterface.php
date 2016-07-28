<?php

namespace SellerWorks\Amazon\Common;

/**
 * Interface for all client objects.
 */
interface ClientInterface
{
    const VERSION = '2.0-beta';

    /**
     * Send an MWS request.
     *
     * @param  RequestInterface  $request
     * @return PromiseInterface
     */
    function send(RequestInterface $request);
}