<?php

namespace SellerWorks\Amazon\Common;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Interface for all client objects.
 */
interface ClientInterface
{
    /**
     * Set event dispatcher.
     *
     * @param  EventDispatcherInterface  $eventDispatcher
     * @return self
     */
    function setEventDispatcher(EventDispatcherInterface $eventDispatcher);
}
