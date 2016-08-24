<?php

namespace SellerWorks\Amazon\Tests\Reports\Serializer;

use SellerWorks\Amazon\Reports\Entity;
use SellerWorks\Amazon\Reports\Request;

/**
 * Serializer tests
 */
class CheckMetadata
{
    /**
     * Test for metadata interface on objects.
     */
    public static function getMetadataClasses()
    {
        return [
            // Requests.
            Request\GetReportRequestListRequest::class,
            Request\RequestReportRequest::class,

            // Entities.
            Entity\ReportRequestInfo::class,
            Entity\ResponseMetadata::class,
        ];
    }
}
