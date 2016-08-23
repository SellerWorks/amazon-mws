<?php

namespace SellerWorks\Amazon\Reports\Request;

use SellerWorks\Amazon\Common\RequestInterface;
use SellerWorks\Amazon\Reports\Entity\ReportType;

/**
 * Creates a report request and submits the request to Amazon MWS.
 */
final class RequestReportRequest implements RequestInterface
{
    /**
     * @enum ReportType
     */
    public $ReportType;

    /**
     * @var DateTimeInterface|string
     */
    public $StartDate;

    /**
     * @var DateTimeInterface|string
     */
    public $EndDate;

    /**
     * @var string
     */
    public $ReportOptions;

    /**
     * @var Array<string>
     */
    public $MarketplaceIdList;

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'ReportType'        => ['type' => 'choice', 'multiple' => false, 'choice' => ReportType::getTypes()],
            'StartDate'         => ['type' => 'datetime'],
            'EndDate'           => ['type' => 'datetime'],
            'ReportOptions'     => ['type' => 'scalar'],
            'MarketplaceIdList' => ['type' => 'choice', 'multiple' => true, 'namespace' => 'Id'],
        ];
    }
}
