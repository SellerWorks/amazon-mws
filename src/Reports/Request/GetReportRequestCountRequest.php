<?php

namespace SellerWorks\Amazon\Reports\Request;

use SellerWorks\Amazon\Common\RequestInterface;
use SellerWorks\Amazon\Reports\Entity\ReportType;

/**
 * Returns a count of report requests that have been submitted to Amazon MWS for processing.
 */
final class GetReportRequestCountRequest implements RequestInterface
{
    /**
     * @var Array<string>
     */
    public $ReportTypeList;

    /**
     * @var Array<string>
     */
    public $ReportProcessingStatusList;

    /**
     * @var DateTimeInterface|string
     */
    public $RequestedFromDate;

    /**
     * @var DateTimeInterface|string
     */
    public $RequestedToDate;

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'ReportTypeList'            => ['type' => 'choice', 'multiple' => true, 'choice' => ReportType::getTypes()],
            'ReportProcessingStatusList'=> ['type' => 'choice', 'multiple' => true, 'choice' => [
                '_SUBMITTED_',
                '_IN_PROGRESS_',
                '_CANCELLED_',
                '_DONE_',
                '_DONE_NO_DATA_',
            ]],
            'RequestedFromDate'         => ['type' => 'datetime'],
            'RequestedToDate'           => ['type' => 'datetime'],
        ];
    }
}
