<?php

namespace SellerWorks\Amazon\Common;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Interface for all client objects.
 */
interface ClientInterface
{
    /**
     * Set the region of service to use.
     *
     * @param  enum  $region
     * @return self
     */
    function setRegion($region);

    /**
     * Send an MWS request.
     *
     * @param  RequestInterface  $request
     * @return PromiseInterface
     */
    function send(RequestInterface $request);

    /**
     * Get event dispatcher.
     *
     * @return EventDispatcherInterface
     */
    function getEventDispatcher();

    /**
     * Set event dispatcher.
     *
     * @param  EventDispatcherInterface  $eventDispatcher
     * @return self
     */
    function setEventDispatcher(EventDispatcherInterface $eventDispatcher);
}