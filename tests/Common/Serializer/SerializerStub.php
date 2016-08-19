<?php

namespace SellerWorks\Amazon\Tests\Common\Serializer;

use SellerWorks\Amazon\Common\RequestInterface;

/**
 * Stub class to test Serializer methods.
 */
class SerializerStub implements RequestInterface
{
    public $_array;
    public $_boolean;
    public $_choice;
    public $_choiceV;
    public $_choiceM;
    public $_choiceMV;
    public $_date;
    public $_datetime;
    public $_object;
    public $_range;
    public $_scalar;

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            '_array'    => ['type' => 'array',      'subtype' => static::class, 'namespace' => 'key'],
            '_boolean'  => ['type' => 'boolean'],
            '_choice'   => ['type' => 'choice',     'choices' => [], 'multiple' => false],
            '_choiceV'  => ['type' => 'choice',     'choices' => ['valid', 'valid_2'], 'multiple' => false],
            '_choiceM'  => ['type' => 'choice',     'choices' => [], 'multiple' => true, 'namespace' => 'key'],
            '_choiceMV' => ['type' => 'choice',     'choices' => ['valid', 'valid_2'], 'multiple' => true, 'namespace' => 'key'],
            '_date'     => ['type' => 'date'],
            '_datetime' => ['type' => 'datetime',   'format' => 'Y-m-d H:i:s'],
            '_object'   => ['type' => 'object',     'subtype' => static::class],
            '_range'    => ['type' => 'range',      'min' => 0, 'max' => 10],
            '_scalar'   => ['type' => 'scalar'],
            
            '_invalid_property_test' => ['type' => 'scalar'],
        ];
    }
}
