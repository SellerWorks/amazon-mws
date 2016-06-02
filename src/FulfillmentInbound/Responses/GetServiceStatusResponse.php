<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;

use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;
use SellerWorks\Amazon\MWS\Common\AbstractResponse;

/**
 * GetServiceStatus response object.
 */
final class GetServiceStatusResponse implements ResponseInterface, XmlDeserializable
{
    /**
     * @var GetServiceStatusResult
     */
    public $GetServiceStatusResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;
}