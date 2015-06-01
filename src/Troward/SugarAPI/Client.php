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
     * Configuration used for sending HTTP Requests
     *
     * @var Config
     */
    protected $config;

    /**
     *
     */
    function __construct()
    {
        $this->config = Config::get();
    }

    /**
     * Builds the HTTP Request Parameters
     *
     * @param $limit
     * @param array $filters
     * @param array $fields
     * @param array $orderBy
     * @param Token $token
     * @return array
     */
    protected function buildParameters($limit, array $filters, array $fields, array $orderBy, Token $token)
    {
        return [
            'headers' => ['oauth-token' => $token->getAccessToken()],
            'body' => json_encode(
                [
                    'filter' => [$filters],
                    'max_num' => $limit,
                    'offset' => 0,
                    'fields' => $this->buildFields($fields),
                    'order_by' => $this->buildOrderBy($orderBy)
                ]
            )
        ];
    }

    /**
     * Builds the HTTP Token Request Parameters
     *
     * @return array
     */
    protected function buildTokenParameters()
    {
        return [
            'body' => json_encode([
                    "grant_type" => "password",
                    "client_id" => $this->config->getConsumerKey(),
                    "client_secret" => $this->config->getConsumerSecret(),
                    "username" => $this->config->getUsername(),
                    "password" => $this->config->getPassword(),
                    "platform" => "base"
                ]
            )
        ];
    }

    /**
     * Build the parameter fields
     *
     * @param array $fields
     * @return string
     */
    private function buildFields(array $fields)
    {
        return implode(" ", $fields);
    }

    /**
     * Build the Order By parameter
     *
     * @param array $orderBy
     * @return string
     */
    private function buildOrderBy(array $orderBy)
    {
        if (empty($orderBy)) return "";

        $orderColumn = array_keys($orderBy)[0];

        $orderType = $orderBy[$orderColumn];

        return $orderColumn . ":" . $orderType;
    }

    /**
     * Runs the HTTP Request
     *
     * @param $method
     * @param $uri
     * @param $parameters
     * @return \GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     */
    private function client($method, $uri, $parameters)
    {
        try
        {
            return (new GuzzleClient)->$method($this->config->getUrl() . "/" . $uri, $parameters);
        } catch (\RuntimeException $e)
        {
            throw new ClientException($e->getMessage());
        }
    }

    /**
     * Sends a GET Request
     *
     * @param $uri
     * @param array $fields
     * @return array|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     */
    public function getRequest($uri, array $fields)
    {
        return $this->client("GET", $uri, $fields);
    }

    /**
     * Sends a POST Request
     *
     * @param $uri
     * @param array $fields
     * @return array|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     */
    public function postRequest($uri, array $fields)
    {
        return $this->client("POST", $uri, $fields);
    }

    /**
     * Sends a PUT Request
     *
     * @param $uri
     * @param array $fields
     * @return array|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     */
    public function putRequest($uri, array $fields)
    {
        return $this->client("PUT", $uri, $fields);
    }

    /**
     * Sends a DELETE Request
     *
     * @param $uri
     * @param array $fields
     * @return array|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     */
    public function deleteRequest($uri, array $fields)
    {
        return $this->client("DELETE", $uri, $fields);
    }
}