<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common;

interface RequestInterface
{
	/**
	 * @const  string
	 */
	const DATE_FORMAT = 'Y-m-d\TH:i:s\Z';

    /**
     * Serialize the request into Amazon's dot-notation.
     *
     * @return array
     */
    public function getParameters(): array;
}