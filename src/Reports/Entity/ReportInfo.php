<?php

namespace SellerWorks\Amazon\Reports\Entity;

/**
 * Detailed information about a report.
 */
final class ReportInfo
{
    /**
     * @var string
     */
    public $ReportId;

    /**
     * @enum ReportType
     */
    public $ReportType;

    /**
     * @var string
     */
    public $ReportRequestId;

    /**
     * @var string
     */
    public $AvailableDate;

    /**
     * @var bool
     */
    public $Acknowledged;

    /**
     * @var string
     */
    public $AcknowledgedDate;
}
