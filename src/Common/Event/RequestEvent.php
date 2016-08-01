<?php

namespace SellerWorks\Amazon\Common\Event;

use Symfony\Component\EventDispatcher\Event;

use SellerWorks\Amazon\Common\RequestInterface;

/**
 * Event dispatched when a RequestInterface object is sent.
 */
class RequestEvent extends Event
{
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * Store values.
     *
     * @param  RequestInterface  $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }
}
