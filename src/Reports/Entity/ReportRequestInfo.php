<?php

namespace SellerWorks\Amazon\Reports\Entity;

/**
 * Meta-data returned with the response object.
 */
final class ReportRequestInfo
{
    /**
     * @var string
     */
    public $ReportRequestId;

    /**
     * @enum ReportType
     */
    public $ReportType;

    /**
     * @var string
     */
    public $StartDate;

    /**
     * @var string
     */
    public $EndDate;

    /**
     * @var bool
     */
    public $Scheduled;

    /**
     * @var string
     */
    public $SubmittedDate;

    /**
     * @var string
     */
    public $ReportProcessingStatus;

    /**
     * @var string
     */
    public $GeneratedReportId;

    /**
     * @var string
     */
    public $StartedProcessingDate;

    /**
     * @var string
     */
    public $CompletedDate;
}
