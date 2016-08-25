<?php

namespace SellerWorks\Amazon\Reports\Serializer;

use UnexpectedValueException;

use SellerWorks\Amazon\Common\RequestInterface;
use SellerWorks\Amazon\Common\SerializerInterface;
use SellerWorks\Amazon\Common\Serializer\Serializer as BaseSerializer;
use SellerWorks\Amazon\Reports\Request;

/**
 * Request Serializer / Response Deserializer.
 */
final class Serializer extends BaseSerializer implements SerializerInterface
{
    /**
     * @var Sabre\Xml\Service
     */
    private $xmlDeserializer;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->xmlDeserializer = new XmlDeserializer;
    }

    /**
     * {@inheritDoc}
     */
    public function serialize(RequestInterface $request)
    {
        // Validate request is valid type and set action.
        switch (true) {
            case $request instanceof Request\RequestReportRequest:
                $action = 'RequestReport';
                break;

            case $request instanceof Request\GetReportRequestListRequest:
                $action = 'GetReportRequestList';
                break;

            case $request instanceof Request\GetReportRequestListByNextTokenRequest:
                $action = 'GetReportRequestListByNextToken';
                break;

            case $request instanceof Request\GetReportRequestCountRequest:
                $action = 'GetReportRequestCount';
                break;

            case $request instanceof Request\CancelReportRequestsRequest:
                $action = 'CancelReportRequests';
                break;

            case $request instanceof Request\GetReportListRequest:
                $action = 'GetReportList';
                break;

            case $request instanceof Request\GetReportListByNextTokenRequest:
                $action = 'GetReportListByNextToken';
                break;

            case $request instanceof Request\GetReportCountRequest:
                $action = 'GetReportCount';
                break;

            case $request instanceof Request\GetReportRequest:
                $action = 'GetReport';
                break;

            default:
                throw new UnexpectedValueException(get_class($request) . ' is not supported.');
        }

        return $this->serializeProperties($action, $request);
    }

    /**
     * {@inheritDoc}
     */
    public function unserialize($response)
    {
        return $this->xmlDeserializer->parse($response);
    }
}
