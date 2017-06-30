<?php

namespace SellerWorks\Amazon\Common;

/**
 * Marketplace enumeration.
 */
final class Marketplace
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
     * Get marketplace id.
     *
     * @param  string $marketplace
     * @return string
     *
     * @throws InvalidArgumentException
     */
    public static function getId(string $marketplace): ?string
    {
        $ids = [
            // NA region
            self::CA => 'A2EUQ1WTGCTBG2',
            self::MX => 'A1AM78C64UM0Y8',
            self::US => 'ATVPDKIKX0DER',

            // EU region
            self::DE => 'A1PA6795UKMFR9',
            self::ES => 'A1RKKUPIHCS9HS',
            self::FR => 'A13V1IB3VIYZZH',
            self::IN => 'A21TJRUUN4KGV',
            self::IT => 'APJ6JRA9NG5V4',
            self::UK => 'A1F83G8C2ARO7P',

            // FE region
            self::JP => 'A1VC38T7YXB528',

            // CN region
            self::CN => 'AAHKV2X7AFYLW',
        ];

        if (array_key_exists($marketplace, $ids)) {
            return $ids[$marketplace];
        }

        throw new \InvalidArgumentException(sprintf('"%s" is not a valid Marketplace value.', $marketplace));
    }

    /**
     * Get host name.
     *
     * @param  string $marketplace
     * @return string
     *
     * @throws InvalidArgumentException
     */
    public static function getHost(string $marketplace): ?string
    {
        $hosts = [
            // NA region
            self::CA => 'mws.amazonservices.ca',
            self::MX => 'mws.amazonservices.com.mx',
            self::US => 'mws.amazonservices.com',

            // EU region
            self::DE => 'mws-eu.amazonservices.com',
            self::ES => 'mws-eu.amazonservices.com',
            self::FR => 'mws-eu.amazonservices.com',
            self::IN => 'mws.amazonservices.in',
            self::IT => 'mws-eu.amazonservices.com',
            self::UK => 'mws-eu.amazonservices.com',

            // FE region
            self::JP => 'mws.amazonservices.jp',

            // CN region
            self::CN => 'mws.amazonservices.com.cn',
        ];

        if (array_key_exists($marketplace, $hosts)) {
            return $hosts[$marketplace];
        }

        throw new \InvalidArgumentException(sprintf('"%s" is not a valid Marketplace value.', $marketplace));
    }

    /**
     * Get valid values.
     *
     * @return array
     */
    public static function values(): array
    {
        return [
            // NA region
            self::CA,
            self::MX,
            self::US,

            // EU region
            self::DE,
            self::ES,
            self::FR,
            self::IN,
            self::IT,
            self::UK,

            // FE region
            self::JP,

            // CN region
            self::CN,
        ];
    }
}
