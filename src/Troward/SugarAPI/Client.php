<?php namespace Troward\SugarAPI;

use Troward\SugarAPI\Contracts\ConfigContract;
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
    protected $config;

    /**
     *
     */
    function __construct()
    {
        $this->config = $this->hasValidConfig(Config::get());
    }

    /**
     * @param ConfigContract $config
     * @return ConfigContract
     */
    private function hasValidConfig(ConfigContract $config)
    {
        if (!$config) throw new ClientException("Sugar Configuration not set");

        if (!$config->getUrl()) throw new ClientException("Missing SugarCRM URL");

        if (!$config->getUsername()) throw new ClientException("Missing SugarCRM Username");

        if (!$config->getPassword()) throw new ClientException("Missing SugarCRM Password");

        if (!$config->getConsumerKey()) throw new ClientException("Missing API Consumer Key");

        if (!$config->getConsumerSecret()) throw new ClientException("Missing API Consumer Secret");

        return $config;
    }

    /**
     * @param $method
     * @param $uri
     * @param array $parameters
     * @return array
     */
    private function client($method, $uri, array $parameters, $token)
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
     * @param $token
     * @return array
     */
    private function buildParameters(array $parameters, $token)
    {
        return [
            'headers' => ['oauth-token' => $token ?: $token['access_token']],
            'body' => json_encode($parameters)
        ];
    }

    /**
     * @param $uri
     * @param array $parameters
     * @param null $token
     * @return array
     */
    public function getRequest($uri, array $parameters, $token = null)
    {
        return $this->client('GET', $uri, $parameters, $token);
    }

    /**
     * @param $uri
     * @param array $parameters
     * @param null $token
     * @return array
     */
    public function postRequest($uri, array $parameters, $token = null)
    {
        return $this->client('POST', $uri, $parameters, $token);
    }

    /**
     * @param $uri
     * @param array $parameters
     * @param null $token
     * @return array
     */
    public function putRequest($uri, array $parameters, $token = null)
    {
        return $this->client('PUT', $uri, $parameters, $token);
    }

    /**
     * @param $uri
     * @param null $token
     * @return array
     */
    public function deleteRequest($uri, $token = null)
    {
        return $this->client('DELETE', $uri, [], $token);
    }
}