<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common;

use Psr\LoggerInterface;

/**
 * Abstract Amazon MWS API Client
 */
abstract class AbstractClientBuilder
{
    /**
     * @var Psr\LoggerInterface
     */
    protected $log;

    /**
     * @var SellerWorks\Amazon\MWS\Common\Passport
     */
    protected $passport;

    /**
     * Construct client using paramters.
     *
     * @param  $SellerId
     * @param  $AccessKey
     * @param  $SecretKey
     * @param  $MwsAuthToken
     * @return void
     */
    public function __construct(string $SellerId, string $AccessKey, string $SecretKey, string $MwsAuthToken = null)
    {
        $this->passport = new Passport($SellerId, $AccessKey, $SecretKey, $MwsAuthToken);
    }

    /**
     * Enable logging.
     *
     * @param  Psr\Logger $log
     * @return ClientBuilder
     */
    public function withLog(LoggerInterface $log)
    {
        $this->log = $log;

        return $this;
    }

    /**
     * Build and return the Client object.
     *
     * @return AbstractClient
     */
    abstract public function build(AbstractClient $client): AbstractClientBuilder
    {
        $client->setPassport($this->passport);

        return $client;
    }
}