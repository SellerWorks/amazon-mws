<?php

namespace SellerWorks\Amazon\Reports\Request;

use SellerWorks\Amazon\Common\RequestInterface;
use SellerWorks\Amazon\Reports\Entity\ReportType;

/**
 * Returns a count of the reports, created in the previous 90 days, with a status of _DONE_ and that are available for
 * download.
 */
final class GetReportCountRequest implements RequestInterface
{
    /**
     * @var Array<string>
     */
    public $ReportTypeList;

    /**
     * @var bool
     */
    public $Acknowledged;

    /**
     * @var DateTimeInterface|string
     */
    public $AvailableFromDate;

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
            'Acknowledged'              => ['type' => 'boolean'],
            'AvailableFromDate'         => ['type' => 'datetime'],
            'AvailableToDate'           => ['type' => 'datetime'],
        ];
    }
}
