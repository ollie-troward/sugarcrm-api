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
     * @param null $token
     * @return array
     */
    private function client($method, $uri, array $parameters, $token = null)
    {
        try
        {
            return (new GuzzleClient)->$method($this->buildUrl($uri), $this->buildParameters($parameters, $token))->json();
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
     * @param null $token
     * @return array
     */
    private function buildParameters(array $parameters, $token)
    {
        return [
            'headers' => ['oauth-token' => $token],
            'body' => json_encode($parameters)
        ];
    }

    /**
     * @param $uri
     * @param array $parameters
     * @return array
     */
    public function get($uri, array $parameters)
    {
        return $this->client(__FUNCTION__, $uri, $parameters);
    }

    /**
     * @param $uri
     * @param $parameters
     * @return array
     */
    public function post($uri, array $parameters)
    {
        return $this->client(__FUNCTION__, $uri, $parameters);
    }

    /**
     * @param $uri
     * @param array $parameters
     * @return array
     */
    public function put($uri, array $parameters)
    {
        return $this->client(__FUNCTION__, $uri, $parameters);
    }

    /**
     * @param $uri
     * @param array $parameters
     * @return array
     */
    public function delete($uri, array $parameters)
    {
        return $this->client(__FUNCTION__, $uri, $parameters);
    }
}