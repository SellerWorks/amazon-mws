<?php

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;

use SellerWorks\Amazon\MWS\Common\AbstractRequest;

final class GetServiceStatusRequest extends AbstractRequest
{
    public function getParameters()
    {
        return [
            'Action' => 'GetServiceStatus',
        ];
    }
}