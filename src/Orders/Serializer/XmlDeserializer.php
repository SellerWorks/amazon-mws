<?php

namespace SellerWorks\Amazon\Orders\Serializer;

use SellerWorks\Amazon\Common\Serializer\XmlDeserializer as BaseXmlDeserializer;

/**
 * Sabre\Xml\Service element map.
 */
final class XmlDeserializer extends BaseXmlDeserializer
{
    /**
     * @const string
     */
    const NS = 'https://mws.amazonservices.com/Orders/2013-09-01';

    /**
     * Local element map.
     *
     * @return array
     */
    public function getElementMap()
    {
        $namespace = static::NS;

        return [
            // Response objects.


            // Result objects.


            // Collection objects.


            // Type objects.


            // Lists.
        ];
    }
}
