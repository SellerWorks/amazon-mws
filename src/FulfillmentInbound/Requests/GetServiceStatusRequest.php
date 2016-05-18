<?php

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;

use SellerWorks\Amazon\MWS\Common\RequestInterface;

final class GetServiceStatusRequest implements RequestInterface
{
    /**
     * {@inheritDoc}
     */
    public function getParameters()
    {
        $request = [
            'Action' => 'GetServiceStatus',
        ];

        return $request;
    }
}