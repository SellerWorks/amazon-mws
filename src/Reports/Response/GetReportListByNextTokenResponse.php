<?php

namespace SellerWorks\Amazon\Reports\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * GetReportListByNextToken response.
 */
final class GetReportListByNextTokenResponse implements ResponseInterface
{
    /**
     * @var GetReportListResult
     */
    public $GetReportListByNextTokenResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->GetReportListByNextTokenResult;
    }
}
