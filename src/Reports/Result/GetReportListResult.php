<?php

namespace SellerWorks\Amazon\Reports\Result;

use SellerWorks\Amazon\Common\IterableResultInterface;
use SellerWorks\Amazon\Common\IterableResultTrait;
use SellerWorks\Amazon\Reports\Request\GetReportListByNextTokenRequest;

/**
 * GetReportRequestList result.
 */
final class GetReportListResult implements IterableResultInterface
{
    /**
     * @property  $client
     * @method  setClient
     * @method  getIterator
     */
    use IterableResultTrait;

    /**
     * @var string
     */
    public $NextToken;

    /**
     * @var boolean
     */
    public $HasNext;

    /**
     * @var Array<ReportInfo>
     */
    public $ReportInfo;

    /**
     * IterableResultInterface::getNextMethod
     */
    public function getNextMethod()
    {
        return 'GetReportListByNextToken';
    }

    /**
     * IterableResultInterface::getNextRequest
     */
    public function getNextRequest()
    {
        if ('false' == $this->HasNext || empty($this->NextToken)) {
            return null;
        }

        $request = new GetReportListByNextTokenRequest;
        $request->NextToken = $this->NextToken;

        return $request;
    }

    /**
     * IterableResultInterface::getRecords
     */
    public function getRecords()
    {
        return $this->ReportInfo?: [];
    }
}
