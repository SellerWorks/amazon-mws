<?php

namespace SellerWorks\Amazon\Reports\Serializer;

use SellerWorks\Amazon\Common\Serializer\XmlDeserializer as BaseXmlDeserializer;
use SellerWorks\Amazon\Reports\Entity;
use SellerWorks\Amazon\Reports\Response;
use SellerWorks\Amazon\Reports\Result;

/**
 * Sabre\Xml\Service element map.
 */
final class XmlDeserializer extends BaseXmlDeserializer
{
    /**
     * @const string
     */
    const NS = 'http://mws.amazonaws.com/doc/2009-01-01/';

    /**
     * Local element map.
     *
     * @return array
     */
    public function getElementMap()
    {
        $ns = sprintf('{%s}', static::NS);

        return [
            // Response objects.
            "{$ns}GetReportRequestListResponse"     => $this->mapObject(Response\GetReportRequestListResponse::class),
            "{$ns}RequestReportResponse"            => $this->mapObject(Response\RequestReportResponse::class),

            "{$ns}ErrorResponse"                    => $this->mapObject(Response\ErrorResponse::class),
            "{$ns}GetServiceStatusResponse"         => $this->mapObject(Response\GetServiceStatusResponse::class),


            // Result objects.
            "{$ns}GetReportRequestListResult"       => $this->mapObject(Result\GetReportRequestListResult::class),
            "{$ns}RequestReportResult"              => $this->mapObject(Result\RequestReportResult::class),

            "{$ns}Error"                            => $this->mapObject(Result\Error::class),
            "{$ns}GetServiceStatusResult"           => $this->mapObject(Result\GetServiceStatusResult::class),


            // Collection objects.


            // List objects.


            // Entity objects.
            "{$ns}ReportRequestInfo"                => $this->mapObject(Entity\ReportRequestInfo::class),

            "{$ns}ResponseMetadata"                 => $this->mapObject(Entity\ResponseMetadata::class),
        ];
    }
}
