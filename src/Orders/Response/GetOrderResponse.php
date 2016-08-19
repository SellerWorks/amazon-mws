<?php

namespace SellerWorks\Amazon\Orders\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * Returns orders based on the AmazonOrderId values that you specify.
 */
final class GetOrderResponse implements ResponseInterface
{
    /**
     * @var GetOrderResult
     */
    public $GetOrderResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->GetOrderResult;
    }
}
