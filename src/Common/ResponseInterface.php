<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common;

interface ResponseInterface
{
    /**
     * Unserialize the XML response.
     *
     * @return self
     */
    public static function xmlUnserialize(): self;
}