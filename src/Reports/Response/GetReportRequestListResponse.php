<?php

namespace SellerWorks\Amazon\Reports\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * GetReportRequestList response.
 */
final class GetReportRequestListResponse implements ResponseInterface
{
    /**
     * @var GetReportRequestListResult
     */
    public $GetReportRequestListResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->GetReportRequestListResult;
    }
}
