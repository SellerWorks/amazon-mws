<?php

namespace SellerWorks\Amazon\Reports\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * GetReportRequestCount response.
 */
final class GetReportRequestCountResponse implements ResponseInterface
{
    /**
     * @var GetReportRequestCountResult
     */
    public $GetReportRequestCountResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->GetReportRequestCountResult;
    }
}
