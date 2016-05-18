<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common;

interface RequestInterface
{
    /**
     * Serialize the request into Amazon's dot-notation.
     *
     * @return array
     */
    public function getParameters(): array;
}