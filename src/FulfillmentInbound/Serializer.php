<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound;

use ReflectionProperty;
use SellerWorks\Amazon\MWS\Common\RequestInterface;
use SellerWorks\Amazon\MWS\Common\ResponseInterface;
use SellerWorks\Amazon\MWS\Common\SerializerInterface;

/**
 */
class Serializer implements SerializerInterface
{
	/**
	 * @const  string
	 */
	const DATE_FORMAT = 'Y-m-d\TH:i:s\Z';

    /**
     * @var  Sabre\Xml\Service
     */
    protected $xmlService;

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->xmlService = new XmlService;
    }

    /**
     * {@inheritDoc}
     */
    public function serialize(RequestInterface $request): array
    {
        
    }

    /**
     * {@inheritDoc}
     */
    public function unserialize(string $response): ResponseInterface
    {
        return $this->xmlService->parse($response);
    }

    /**
     * Serialize ListInboundShipmentsRequest.
     *
     * @param  Requests\ListInboundShipmentsRequest
     * @return array
     */
    protected function serializeListInboundShipmentsRequest(ListInboundShipmentsRequest $request): array
    {
        $retArr = ['Action' => 'ListInboundShipments'];
    }
}