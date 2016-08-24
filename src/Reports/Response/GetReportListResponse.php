<?php

namespace SellerWorks\Amazon\Reports\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * GetReportList response.
 */
final class GetReportListResponse implements ResponseInterface
{
    /**
     * @var GetReportListResult
     */
    public $GetReportListResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->GetReportListResult;
    }
}
