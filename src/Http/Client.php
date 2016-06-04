<?php

namespace Alegra\Http;

use Alegra\Api;
use Illuminate\Support\Arr;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Contracts\Support\Arrayable;

class Client
{

    /**
    * Instance of the GuzzleHttp\Client
    *
    * @var \GuzzleHttp\ClientInterface
    */
    protected static $transport;

    public static function request($method, $path, $params = [])
    {
        return static::get()->request(
            $method = strtoupper($method),
            $path,
            static::resolveParameters($method, $params)
        );
    }

    /**
     * Set the htpp client for request resource.
     *
     * @param array $options
     */
    public static function create(array $options = [])
    {
        $options = array_merge(
            [
                'base_uri' => Api::baseUri(),
                'auth'     => Api::auth(),
                'headers' => [
                    'Accept' => 'application/json'
                ]
            ],
            $options
        );

        return static::$transport = new HttpClient($options);
    }

    /**
     * Get instance of the http client
     *
     * @return \GuzzleHttp\ClientInterface
     */
    protected static function get()
    {
        return static::$transport ?: static::create();
    }

    /**
     * Resolve parameters for request
     *
     * @param  array|Arrayable $params
     * @return array
     */
    private static function resolveParameters($method, $params)
    {
        $options = [];

        if ($params instanceof Arrayable) {
            $params = $params->toArray();
        } else {
            $params = (array) $params;
        }

        if ($params) {
            $options[$method === 'GET' ? 'query' : 'json'] = $params;
        }

        return $options;
    }
}