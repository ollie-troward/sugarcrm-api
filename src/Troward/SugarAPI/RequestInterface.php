<?php namespace Troward\SugarAPI;

interface RequestInterface
{
    /**
     * Runs the HTTP Request
     *
     * @param $method
     * @param $uri
     * @param $parameters
     * @return \GuzzleHttp\Message\ResponseInterface
     * @throws SugarResponseException
     */
    public function send($method, $uri, $parameters);

    /**
     * Sends a GET Request
     *
     * @param $uri
     * @param array $fields
     * @return Result
     */
    public function get($uri, array $fields);

    /**
     * Sends a POST Request
     *
     * @param $uri
     * @param array $fields
     * @return Result
     */
    public function post($uri, array $fields);

    /**
     * Sends a PUT Request
     *
     * @param $uri
     * @param array $fields
     * @return Result
     */
    public function put($uri, array $fields);

    /**
     * Sends a DELETE Request
     *
     * @param $uri
     * @param array $fields
     * @return Result
     */
    public function delete($uri, array $fields);
}