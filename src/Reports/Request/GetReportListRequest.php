<?php

namespace SellerWorks\Amazon\Reports\Request;

use SellerWorks\Amazon\Common\RequestInterface;
use SellerWorks\Amazon\Reports\Entity\ReportType;

/**
 * Returns a list of reports that were created in the previous 90 days.
 */
final class GetReportListRequest implements RequestInterface
{
    /**
     * @var int
     */
    public $MaxCount;

    /**
     * @var Array<string>
     */
    public $ReportTypeList;

    /**
     * @var boolean
     */
    public $Acknowledged;

    /**
     * @var DateTimeInterface|string
     */
    public $AvailableFromDate;

    /**
     * @var DateTimeInterface|string
     */
    public $AvailableToDate;

    /**
     * @var Array<string>
     */
    public $ReportRequestIdList;

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'MaxCount'                  => ['type' => 'range', 'min' => 1, 'max' => 100],
            'ReportTypeList'            => ['type' => 'choice', 'multiple' => true, 'choice' => ReportType::getTypes()],
            'Acknowledged'              => ['type' => 'boolean'],
            'AvailableFromDate'         => ['type' => 'datetime'],
            'AvailableToDate'           => ['type' => 'datetime'],
            'ReportRequestIdList'       => ['type' => 'choice', 'multiple' => true, 'namespace' => 'Id'],
        ];
    }
}
