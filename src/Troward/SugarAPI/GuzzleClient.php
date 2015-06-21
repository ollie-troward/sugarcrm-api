<?php namespace Troward\SugarAPI;

use Troward\SugarAPI\Exceptions\ClientException;
use Troward\SugarAPI\Exceptions\GuzzleClientException;
use Troward\SugarAPI\Contracts\ClientContract;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

/**
 * Class GuzzleClient
 * @package Troward\SugarAPI
 */
class GuzzleClient implements ClientContract
{
    /**
     * Client used for HTTP Requests
     *
     * @var GuzzleClient
     */
    protected $client;

    /**
     * Configuration used the requests
     *
     * @var Config
     */
    protected $config;

    /**
     *
     */
    function __construct()
    {
        $this->client = new Client;
        $this->config = Config::get();
    }

    /**
     * Runs the HTTP Request
     *
     * @param $method
     * @param $uri
     * @param $parameters
     * @return \GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     */
    private function request($method, $uri, $parameters)
    {
        try
        {
            return $this->client->$method($this->config->getUrl() . "/" . $uri, $parameters);
        } catch (BadResponseException $e)
        {
            throw new GuzzleClientException($e);
        }
    }

    /**
     * Sends a GET Request
     *
     * @param $uri
     * @param array $fields
     * @return array|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     */
    public function get($uri, array $fields)
    {
        return $this->request(__FUNCTION__, $uri, $fields);
    }

    /**
     * Sends a POST Request
     *
     * @param $uri
     * @param array $fields
     * @return array|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     */
    public function post($uri, array $fields)
    {
        return $this->request(__FUNCTION__, $uri, $fields);
    }

    /**
     * Sends a PUT Request
     *
     * @param $uri
     * @param array $fields
     * @return array|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     */
    public function put($uri, array $fields)
    {
        return $this->request(__FUNCTION__, $uri, $fields);
    }

    /**
     * Sends a DELETE Request
     *
     * @param $uri
     * @param array $fields
     * @return array|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     */
    public function delete($uri, array $fields)
    {
        return $this->request(__FUNCTION__, $uri, $fields);
    }
}