<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;

use SellerWorks\Amazon\MWS\Common\ResponseInterface;
use Sabre\Xml\Element\KeyValue;
use Sabra\Xml\Reader;
use Sabra\Xml\XmlDeserializable;

/**
 */
final class GetServiceStatusResponse implements ResponseInterface, XmlDeserializable
{
    /**
     */
    protected $GetServiceStatusResult;

    /**
     */
    protected $ResponseMetadata;

    public static function xmlDeserialize(Reader $reader)
    {
        $obj = new self();
        $values = KeyValue::xmlDeserialize($reader);
    }
}