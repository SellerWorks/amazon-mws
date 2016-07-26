<?php

namespace SellerWorks\Amazon\Common;

/**
 * Interface for Request/Response Message Serialization.
 */
interface SerializerInterface
{
	/**
	 * @const string
	 */
	const DATE_FORMAT = 'Y-m-d\TH:i:s\Z';

    /**
     * Serialize request into dot-notation hash.
     *
     * @param  RequestInterface  $request
     * @return array
     */
    function serialize(RequestInterface $request);

    /**
     * Deserialize response into objects.
     *
     * @param  string  $response
     * @return ResponseInterface
     */
    function unserialize(string $response);
}