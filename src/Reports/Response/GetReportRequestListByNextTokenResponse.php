<?php

namespace SellerWorks\Amazon\Reports\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * GetReportRequestListByNextToken response.
 */
final class GetReportRequestListByNextTokenResponse implements ResponseInterface
{
    /**
     * @var GetReportRequestListResult
     */
    public $GetReportRequestListByNextTokenResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->GetReportRequestListByNextTokenResult;
    }
}
