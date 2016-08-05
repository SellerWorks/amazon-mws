<?php

namespace SellerWorks\Amazon\Common;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Interface for all client objects.
 */
interface ClientInterface
{
    /**
     * Send an MWS request.
     *
     * @param  RequestInterface  $request
     * @return PromiseInterface
     */
    function send(RequestInterface $request);

    /**
     * Set event dispatcher.
     *
     * @param  EventDispatcherInterface  $eventDispatcher
     * @return self
     */
    function setEventDispatcher(EventDispatcherInterface $eventDispatcher);
}
