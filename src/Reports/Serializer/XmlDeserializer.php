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
            "{$ns}CancelReportRequestsResponse"             => $this->mapObject(Response\CancelReportRequestsResponse::class),
            "{$ns}GetReportCountResponse"                   => $this->mapObject(Response\GetReportCountResponse::class),
            "{$ns}GetReportListResponse"                    => $this->mapObject(Response\GetReportListResponse::class),
            "{$ns}GetReportListByNextTokenResponse"         => $this->mapObject(Response\GetReportListByNextTokenResponse::class),
            "{$ns}GetReportRequestCountResponse"            => $this->mapObject(Response\GetReportRequestCountResponse::class),
            "{$ns}GetReportRequestListResponse"             => $this->mapObject(Response\GetReportRequestListResponse::class),
            "{$ns}GetReportRequestListByNextTokenResponse"  => $this->mapObject(Response\GetReportRequestListByNextTokenResponse::class),
            "{$ns}GetReportResponse"                        => $this->mapObject(Response\GetReportResponse::class),
            "{$ns}RequestReportResponse"                    => $this->mapObject(Response\RequestReportResponse::class),

            "{$ns}ErrorResponse"                            => $this->mapObject(Response\ErrorResponse::class),
            "{$ns}GetServiceStatusResponse"                 => $this->mapObject(Response\GetServiceStatusResponse::class),


            // Result objects.
            "{$ns}CancelReportRequestsResult"               => $this->mapObject(Result\CancelReportRequestsResult::class),
            "{$ns}GetReportCountResult"                     => $this->mapObject(Result\GetReportCountResult::class),
            "{$ns}GetReportListResult"                      => $this->mapObject(Result\GetReportListResult::class),
            "{$ns}GetReportListByNextTokenResult"           => $this->mapObject(Result\GetReportListResult::class),
            "{$ns}GetReportRequestCountResult"              => $this->mapObject(Result\GetReportRequestCountResult::class),
            "{$ns}GetReportRequestListResult"               => $this->mapObject(Result\GetReportRequestListResult::class),
            "{$ns}GetReportRequestListByNextTokenResult"    => $this->mapObject(Result\GetReportRequestListResult::class),
            "{$ns}GetReportResult"                          => $this->mapObject(Result\GetReportResult::class),
            "{$ns}RequestReportResult"                      => $this->mapObject(Result\RequestReportResult::class),

            "{$ns}Error"                                    => $this->mapObject(Result\Error::class),
            "{$ns}GetServiceStatusResult"                   => $this->mapObject(Result\GetServiceStatusResult::class),


            // Collection objects.


            // List objects.


            // Entity objects.
            "{$ns}ReportInfo"                               => $this->mapObject(Entity\ReportInfo::class),
            "{$ns}ReportRequestInfo"                        => $this->mapObject(Entity\ReportRequestInfo::class),

            "{$ns}ResponseMetadata"                         => $this->mapObject(Entity\ResponseMetadata::class),
        ];
    }
}
