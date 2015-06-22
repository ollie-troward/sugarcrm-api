<?php namespace Troward\SugarAPI;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Troward\SugarAPI\Exceptions\SugarResponseException;

/**
 * Class GuzzleRequest
 * @package Troward\SugarAPI
 */
class GuzzleRequest implements RequestInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var Config
     */
    private $config;

    /**
     * @param Config $config
     */
    function __construct(Config $config)
    {
        $this->client = new Client;
        $this->config = $config;
    }

    /**
     * Runs the HTTP Request
     *
     * @param $method
     * @param $uri
     * @param $parameters
     * @return \GuzzleHttp\Message\ResponseInterface
     * @throws SugarResponseException
     */
    public function send($method, $uri, $parameters)
    {
        try
        {
            return $this->client->$method($this->config->getUrl() . "/" . $uri, $parameters);
        } catch (BadResponseException $e)
        {
            throw new SugarResponseException($e);
        }
    }

    /**
     * Sends a GET Request
     *
     * @param $uri
     * @param array $fields
     * @return Result
     */
    public function get($uri, array $fields)
    {
        return $this->send(__FUNCTION__, $uri, $fields);
    }

    /**
     * Sends a POST Request
     *
     * @param $uri
     * @param array $fields
     * @return Result
     */
    public function post($uri, array $fields)
    {
        return $this->send(__FUNCTION__, $uri, $fields);
    }

    /**
     * Sends a PUT Request
     *
     * @param $uri
     * @param array $fields
     * @return Result
     */
    public function put($uri, array $fields)
    {
        return $this->send(__FUNCTION__, $uri, $fields);
    }

    /**
     * Sends a DELETE Request
     *
     * @param $uri
     * @param array $fields
     * @return Result
     */
    public function delete($uri, array $fields)
    {
        return $this->send(__FUNCTION__, $uri, $fields);
    }
}