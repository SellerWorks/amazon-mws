<?php

namespace SellerWorks\Amazon\Common;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;

use SellerWorks\Amazon\Passport\Passport;
use SellerWorks\Amazon\Passport\PassportAwareInterface;
use SellerWorks\Amazon\Passport\PassportAwareTrait;
use SellerWorks\Amazon\Passport\PassportInterface;

/**
 * Base client class for all MWS endponints.
 */
class AbstractClient
{
    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     */
    public function __construct(PassportInterface $passport = null)
    {
        
    }

    /**
     * Get event dispatcher.
     *
     * @return EventDispatcherInterface
     */
    public function getEventDispatcher()
    {
        if (null === $this->eventDispatcher) {
            $this->eventDispatcher = new EventDispatcher;
        }

        return $this->eventDispatcher;
    }

    /**
     * Set event dispatcher.
     *
     * @param  EventDispatcherInterface  $eventDispatcher
     * @return self
     */
    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;

        return $this;
    }

    /**
     * Dispatch an event.
     *
     * @param  string  $name
     * @param  Event  $event
     * @return Event
     */
    protected function dispatch($name, Event $event)
    {
        return $this->getEventDispatcher()->dispatch($name, $event);
    }
}