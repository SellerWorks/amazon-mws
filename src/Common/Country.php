<?php

namespace SellerWorks\Amazon\Common;

use CommerceGuys\Enum\AbstractEnum;

/**
 * Country enumeration.
 */
final class Country extends AbstractEnum
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
     * Get host by country.
     *
     * @param  string $country
     * @return string
     *
     * @throws InvalidArgumentException
     */
    public static function getHost(string $country): ?string
    {
        $hosts = [
            // NA region
            Country::CA => 'mws.amazonservices.ca',
            Country::MX => 'mws.amazonservices.com.mx',
            Country::US => 'mws.amazonservices.com',

            // EU region
            Country::DE => 'mws-eu.amazonservices.com',
            Country::ES => 'mws-eu.amazonservices.com',
            Country::FR => 'mws-eu.amazonservices.com',
            Country::IN => 'mws.amazonservices.in',
            Country::IT => 'mws-eu.amazonservices.com',
            Country::UK => 'mws-eu.amazonservices.com',

            // FE region
            Country::JP => 'mws.amazonservices.jp',

            // CN region
            Country::CN => 'mws.amazonservices.com.cn',
        ];

        if (array_key_exists($country, $hosts)) {
            return $hosts[$country];
        }

        throw new \InvalidArgumentException(sprintf('"%s" is not a valid Country value.', $country));
    }

    /**
     * Get host by country.
     *
     * @param  string $country
     * @return string
     *
     * @throws InvalidArgumentException
     */
    public static function getMarketplaceId(string $country): ?string
    {
        $ids = [
            // NA region
            Country::CA => 'A2EUQ1WTGCTBG2',
            Country::MX => 'A1AM78C64UM0Y8',
            Country::US => 'ATVPDKIKX0DER',

            // EU region
            Country::DE => 'A1PA6795UKMFR9',
            Country::ES => 'A1RKKUPIHCS9HS',
            Country::FR => 'A13V1IB3VIYZZH',
            Country::IN => 'A21TJRUUN4KGV',
            Country::IT => 'APJ6JRA9NG5V4',
            Country::UK => 'A1F83G8C2ARO7P',

            // FE region
            Country::JP => 'A1VC38T7YXB528',

            // CN region
            Country::CN => 'AAHKV2X7AFYLW',
        ];

        if (array_key_exists($country, $ids)) {
            return $ids[$country];
        }

        throw new \InvalidArgumentException(sprintf('"%s" is not a valid Country value.', $country));
    }
}
