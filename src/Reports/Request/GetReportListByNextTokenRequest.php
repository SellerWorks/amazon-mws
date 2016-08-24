<?php

namespace SellerWorks\Amazon\Reports\Request;

use SellerWorks\Amazon\Common\RequestInterface;

/**
 * Returns a list of reports using the NextToken, which was supplied by a previous request to either
 * GetReportListByNextToken or GetReportList, where the value of HasNext was true in the previous call.
 */
final class GetReportListByNextTokenRequest implements RequestInterface
{
    /**
     * @var string
     */
    public $NextToken;

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'NextToken' => ['type' => 'scalar'],
        ];
    }
}
