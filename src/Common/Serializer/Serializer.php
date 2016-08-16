<?php

namespace SellerWorks\Amazon\Common\Serializer;

use DateTimeInterface;

use SellerWorks\Amazon\Common\RequestInterface;
use SellerWorks\Amazon\Common\SerializerInterface;

/**
 * Empty Request Serializer / Response Deserializer.
 */
class Serializer implements SerializerInterface
{
    /**
     * {@inheritDoc}
     */
    public function serialize(RequestInterface $request)
    {
        return $request;
    }

    /**
     * {@inheritDoc}
     */
    public function unserialize($response)
    {
        return $response;
    }

    /**
     * @param  string  $action
     * @param  RequestInterface  $request
     * @return array
     */
    protected function serializeProperties($action, RequestInterface $request)
    {
        $parameters = array_merge(['Action' => $action], $this->flatten($request));

        return $parameters;
    }

    /**
     * Flatten objects into dot-notation arrays.
     *
     * @param  mixed  $object
     * @param  string  $path
     * @return array
     */
    protected function flatten($object, $path = null)
    {
        $flattened = [];
        $metadata  = $object->getMetadata();

        foreach ($metadata as $prop => $meta) {
            $key   = ltrim($path.'.'.$prop, '.');
            $value = $object->{$prop};

            if (empty($value) && !is_bool($value)) {
                continue;
            }

            switch ($meta['type']) {
                case 'array':
                    if (!is_array($value)) {
                        $value = [$value];
                    }

                    $defaults = ['namespace' => 'member', 'subtype' => ''];
                    $meta = array_merge($defaults, $meta);
                    $idx  = 1;

                    foreach ($value as $i) {
                        if (is_a($i, $meta['subtype'])) {
                            $idxPath   = sprintf('%s.%s.%s', $key, $meta['namespace'], $idx);
                            $flattened = array_merge($flattened, $this->flatten($i, $idxPath));
                            ++$idx;
                        }
                    }
                    break;

                case 'boolean':
                    if (is_bool($value)) {
                        $flattened[$key] = $value? 'true' : 'false';
                    }
                    elseif ('true' == strtolower($value)) {
                        $flattened[$key] = 'true';
                    }
                    elseif ('false' == strtolower($value)) {
                        $flattened[$key] = 'false';
                    }
                    break;

                case 'choice':
                    $defaults = ['choices' => [], 'multiple' => false, 'namespace' => 'Id'];
                    $meta     = array_merge($defaults, $meta);
                    $validate = !empty($meta['choices']);
 
                    if (false === $meta['multiple']) {
                        if ($validate && !in_array($value, $meta['choices'])) {
                            continue;
                        }

                        $flattened[$key] = $value;
                    } else {
                        $value = array_values((array) $value);
                        $idx  = 1;

                        foreach ($value as $i) {
                            if ($validate && !in_array($i, $meta['choices'])) {
                                continue;
                            }

                            $idxPath = sprintf('%s.%s.%s', $key, $meta['namespace'], $idx);
                            $flattened[$idxPath] = $i;
                            ++$idx;
                        }
                    }
                    break;

                case 'date':
                case 'datetime':
                    if ('datetime' == $meta['type']) {
                        $format = static::DATE_FORMAT;
                    }
                    else {
                        $format = 'Y-m-d';
                    }

                    if ($value instanceof DateTimeInterface) {
                        $flattened[$key] = $value->format($format);
                    }
                    elseif (is_scalar($value) && false !== ($ts = strtotime($value))) {
                        $flattened[$key] = gmdate($format, $ts);
                    }
                    break;

                case 'object':
                    if (class_exists($meta['subtype']) && is_a($value, $meta['subtype'])) {
                        $flattened = array_merge($flattened, $this->flatten($value, $key));
                    }
                    break;

                case 'range':
                    $defaults = ['min' => 1, 'max' => 10];
                    $meta  = array_merge($defaults, $meta);
                    $value = intval($value);
                    $meta['min'] = intval($meta['min']);
                    $meta['max'] = intval($meta['max']);

                    if ($value >= $meta['min'] && $value <= $meta['max']) {
                        $flattened[$key] = $value;
                    }
                    break;

                case 'scalar':
                    if (is_scalar($value)) {
                        $flattened[$key] = $value;
                    }
                    break;

                default:
                    break;
            }
        }

        return $flattened;
    }
}
