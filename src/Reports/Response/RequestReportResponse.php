<?php

namespace SellerWorks\Amazon\Reports\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * RequestReport response.
 */
final class RequestReportResponse implements ResponseInterface
{
    /**
     * @var RequestReportResult
     */
    public $RequestReportResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->RequestReportResult;
    }
}
