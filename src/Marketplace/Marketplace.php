<?php

namespace SellerWorks\Amazon\Marketplace;

/**
 * Amazon MWS Marketplace.
 */
class Marketplace implements MarketplaceInterface
{
    /** @var string */
    private $marketplaceId;

    /** @var string */
    private $host;

    /**
     * @param  string $marketplaceId
     * @param  string $host
     */
    public function __construct(string $marketplaceId, string $host)
    {
        $this->marketplaceId = $marketplaceId;
        $this->host          = $host;
    }

    /**
     * @return string
     */
    public function getMarketplaceId(): string
    {
        return $this->marketplaceId;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }
}
