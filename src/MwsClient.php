<?php

/*
 * This file is part of the Amazon MWS package.
 *
 * (c) Steve Nebes <snebes@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SellerWorks\Amazon;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\HandlerStack;

class MwsClient
{
    /** @var HttpClient */
    private $httpClient;

    /**
     * Default values.
     *
     * @param HttpClient|null $httpClient
     */
    public function __construct(HttpClient $httpClient = null)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return HttpClient
     */
    private function getHttpClient(): HttpClient
    {
        if (null === $this->httpClient) {
            $stack = HandlerStack::create();

            $this->httpClient = new HttpClient([
                'http_errors' => true,
                'stack'       => $stack,
            ]);
        }

        return $this->httpClient;
    }
}
