<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Tests\Common;

use InvalidArgumentException;
use ReflectionMethod;
use ReflectionProperty;
use PHPUnit\Framework\TestCase;
use SellerWorks\Amazon\MWS\Common\AbstractClient;
use SellerWorks\Amazon\MWS\Common\ClientInterface;
use SellerWorks\Amazon\MWS\Common\Mock\MockClient;
use SellerWorks\Amazon\MWS\Common\Mock\MockSerializer;
use SellerWorks\Amazon\MWS\Common\Passport;
use SellerWorks\Amazon\MWS\Common\Requests;
use SellerWorks\Amazon\MWS\Common\ResponseInterface;
use SellerWorks\Amazon\MWS\Common\Responses;
use SellerWorks\Amazon\MWS\Common\ResultInterface;
use SellerWorks\Amazon\MWS\Common\Results;

/**
 * MockClient tests.  Testing only the "abstract" parts of the AbstractClient class.
 */
class AbstractClientBuilderTest extends TestCase
{
    public function test()
    {
        $this->assertTrue(true);
    }
}