<?php

namespace SellerWorks\Amazon\Marketplace;

/**
 * Amazon MWS Marketplace interface.
 */
interface MarketplaceInterface
{
    /**
     * @return string
     */
    public function getMarketplaceId(): string;

    /**
     * @return string
     */
    public function getHost(): string;
}
