<?php

namespace SellerWorks\Amazon\Reports\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * GetReport response.
 */
final class GetReportResponse implements ResponseInterface
{
    /**
     * @var GetReportResult
     */
    public $GetReportResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->GetReportResult;
    }
}
