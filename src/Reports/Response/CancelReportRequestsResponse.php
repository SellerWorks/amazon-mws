<?php

namespace SellerWorks\Amazon\Reports\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * CancelReportRequests response.
 */
final class CancelReportRequestsResponse implements ResponseInterface
{
    /**
     * @var CancelReportRequestsResult
     */
    public $CancelReportRequestsResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->CancelReportRequestsResult;
    }
}
