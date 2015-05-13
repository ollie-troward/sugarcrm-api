<?php namespace Troward\SugarAPI;

use Troward\SugarAPI\Exceptions\ClientException;
use Troward\SugarAPI\Contracts\ClientContract;
use GuzzleHttp\Client as GuzzleClient;

/**
 * Class Client
 * @package Troward\SugarAPI
 */
class Client implements ClientContract {

    /**
     * @var Config
     */
    private $config;

    /**
     * @param Config $config
     */
    function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @param Config $config
     * @return Client
     */
    protected function initialise(Config $config)
    {
        return new self($config);
    }

    /**
     * @param $method
     * @param $uri
     * @param array $parameters
     * @return array
     * @throws ClientException
     */
    private function client($method, $uri, array $parameters)
    {
        try
        {
            return (new GuzzleClient)->$method($this->buildUrl($uri), $this->buildParameters($parameters))->json();
        } catch (\RuntimeException $e)
        {
            throw new ClientException($e->getMessage());
        }
    }

    /**
     * @param $uri
     * @return string
     */
    private function buildUrl($uri)
    {
        return $this->config->getUrl() . '/' . $uri;
    }

    /**
     * @param array $parameters
     * @return array
     */
    private function buildParameters(array $parameters)
    {
        return ['body' => json_encode($parameters)];
    }

    /**
     * @param $uri
     * @param array $parameters
     * @return array
     */
    public function get($uri, array $parameters)
    {
        return $this->client('get', $uri, $parameters);
    }

    /**
     * @param $uri
     * @param $parameters
     * @return array
     */
    public function post($uri, array $parameters)
    {
        return $this->client('post', $uri, $parameters);
    }

    /**
     * @param $uri
     * @param array $parameters
     * @return array
     */
    public function put($uri, array $parameters)
    {
        return $this->client('put', $uri, $parameters);
    }

    /**
     * @param $uri
     * @param array $parameters
     * @return array
     */
    public function delete($uri, array $parameters)
    {
        return $this->client('delete', $uri, $parameters);
    }


}