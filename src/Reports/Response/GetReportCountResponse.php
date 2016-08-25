<?php

namespace SellerWorks\Amazon\Reports\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * GetReportCount response.
 */
final class GetReportCountResponse implements ResponseInterface
{
    /**
     * @var GetReportCountResult
     */
    public $GetReportCountResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->GetReportCountResult;
    }
}
