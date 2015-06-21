<?php namespace Troward\SugarAPI;

use GuzzleHttp\Message\ResponseInterface;
use Troward\SugarAPI\Contracts\SugarBaseContract;

/**
 * Class SugarBase
 * @package Troward\SugarAPI
 */
class SugarBase implements SugarBaseContract
{
    /**
     * The Client used for the API
     *
     * @var GuzzleClient
     */
    protected $client;

    /**
     * Parameter builder for the requests
     *
     * @var Parameter
     */
    protected $parameters;

    /**
     *
     */
    function __construct()
    {
        $this->client = new GuzzleClient;
        $this->parameters = new Parameter;
    }

    /**
     * Retrieves the latest token
     *
     * @return Token
     */
    public function token()
    {
        return Token::retrieve();
    }

    /**
     * @param ResponseInterface $response
     * @return SugarResult
     */
    public function result(ResponseInterface $response)
    {
        return new SugarResult($response);
    }
}