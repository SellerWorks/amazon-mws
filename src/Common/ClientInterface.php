<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common;

/**
 * Interface for all client objects.
 */
interface ClientInterface
{
    /**
     * MWS Service definitions.
     */
	const MWS_PATH    = '';
	const MWS_VERSION = '';

    /**
     * User-agent string for cURL.
     */
	const USER_AGENT = 'SellerWorks Amazon MWS 2016.06';

    /**
     * Countries supported by api.
     */
    // NA Region
    const COUNTRY_CA = 'CA';
    const COUNTRY_MX = 'MX';
    const COUNTRY_US = 'US';

    // EU Region
    const COUNTRY_DE = 'DE';
    const COUNTRY_ES = 'ES';
    const COUNTRY_FR = 'FR';
    const COUNTRY_IN = 'IN';
    const COUNTRY_IT = 'IT';
    const COUNTRY_UK = 'UK';

    // FE Region
    const COUNTRY_JP = 'JP';

    // CN Region
    const COUNTRY_CN = 'CN';
}