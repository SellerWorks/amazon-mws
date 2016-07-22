<?php

namespace SellerWorks\Amazon\Passport;

use InvalidArgumentException;

/**
 * Region information and settings.
 */
final class Region
{
    // NA region
    const CA = 'ca';
    const MX = 'mx';
    const US = 'us';
    
    // EU region
    const DE = 'de';
    const ES = 'es';
    const FR = 'fr';
    const IN = 'in';
    const IT = 'it';
    const UK = 'uk';

    // FE region
    const JP = 'jp';

    // CN region
    const CN = 'cn';

    /**
     * Get default marketplace Id.
     *
     * @param  string  $region
     * @return string
     *
     * @throws InvalidArgumentException
     */
    public static function getDefaultMarketplaceId($region)
    {
        switch ($region) {
            // NA region
            case static::CA: return 'A2EUQ1WTGCTBG2';
            case static::MX: return 'A1AM78C64UM0Y8';
            case static::US: return 'ATVPDKIKX0DER';

            // EU region
            case static::DE: return 'A1PA6795UKMFR9';
            case static::ES: return 'A1RKKUPIHCS9HS';
            case static::FR: return 'A13V1IB3VIYZZH';
            case static::IN: return 'A21TJRUUN4KGV';
            case static::IT: return 'APJ6JRA9NG5V4';
            case static::UK: return 'A1F83G8C2ARO7P';

            // FE region
            case static::JP: return 'A1VC38T7YXB528';

            // CN region
            case static::CN: return 'AAHKV2X7AFYLW';
        }

        throw new InvalidArgumentException(sprintf('Invalid region code: %s', $region));
    }
}
