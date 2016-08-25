<?php

namespace SellerWorks\Amazon\Reports\Request;

use SellerWorks\Amazon\Common\RequestInterface;

/**
 * Returns the contents of a report and the Content-MD5 header for the returned report body.
 */
final class GetReportRequest implements RequestInterface
{
    /**
     * @var string
     */
    public $ReportId;

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'ReportId' => ['type' => 'scalar'],
        ];
    }
}
