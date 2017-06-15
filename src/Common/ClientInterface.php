<?php

namespace SellerWorks\Amazon\Common;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Interface for all client objects.
 */
interface ClientInterface
{
    /**
     * Get the endpoint path.
     *
     * @return string
     */
    public function getPath(): string;

    /**
     * Get the endpoint version.
     *
     * @return string
     */
    public function getVersion(): string;
}
