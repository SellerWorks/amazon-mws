<?php

namespace SellerWorks\Amazon\Reports\Request;

use SellerWorks\Amazon\Common\RequestInterface;
use SellerWorks\Amazon\Reports\Entity\ReportType;

/**
 * Creates a report request and submits the request to Amazon MWS.
 */
final class GetReportRequestListRequest implements RequestInterface
{
    /**
     * @var Array<string>
     */
    public $ReportRequestIdList;

    /**
     * @var Array<string>
     */
    public $ReportTypeList;

    /**
     * @var Array<string>
     */
    public $ReportProcessingStatusList;

    /**
     * @var int
     */
    public $MaxCount;

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
            'ReportRequestIdList'       => ['type' => 'choice', 'multiple' => true, 'namespace' => 'Id'],
            'ReportTypeList'            => ['type' => 'choice', 'multiple' => true, 'choice' => ReportType::getTypes()],
            'ReportProcessingStatusList'=> ['type' => 'choice', 'multiple' => true, 'choice' => [
                '_SUBMITTED_',
                '_IN_PROGRESS_',
                '_CANCELLED_',
                '_DONE_',
                '_DONE_NO_DATA_',
            ]],
            'MaxCount'                  => ['type' => 'range', 'min' => 1, 'max' => 100],
            'RequestedFromDate'         => ['type' => 'datetime'],
            'RequestedToDate'           => ['type' => 'datetime'],
        ];
    }
}
