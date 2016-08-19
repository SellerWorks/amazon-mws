<?php

namespace SellerWorks\Amazon\Common\Event;

use Symfony\Component\EventDispatcher\Event;

use SellerWorks\Amazon\Common\RequestInterface;
use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * Event dispatched when a RequestInterface object is sent.
 */
class ResponseEvent extends Event
{
    /**
     * @var RequestEvent
     */
    protected $requestEvent;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * Store values.
     *
     * @param  RequestEvent  $requestEvent
     * @param  ResponseInterface|PromiseInterface  $response
     */
    public function __construct(RequestEvent $requestEvent, $response)
    {
        $this->requestEvent = $requestEvent;
        $this->response     = $response;
    }

    /**
     * @return RequestEvent
     */
    public function getRequestEvent()
    {
        return $this->requestEvent;
    }

    /**
     * @return ResponseInterface|PromiseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }
}
