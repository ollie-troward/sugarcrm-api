<?php namespace Troward\SugarAPI\Contracts;

/**
 * Interface ClientContract
 * @package Troward\SugarAPI\Contracts
 */
interface ClientContract
{
    /**
     * Sends a GET Request
     *
     * @param $uri
     * @param array $fields
     * @return array
     */
    public function get($uri, array $fields);

    /**
     * Sends a POST Request
     *
     * @param $uri
     * @param array $fields
     * @return array
     */
    public function post($uri, array $fields);

    /**
     * Sends a PUT Request
     *
     * @param $uri
     * @param array $fields
     * @return array
     */
    public function put($uri, array $fields);

    /**
     * Sends a DELETE Request
     *
     * @param $uri
     * @param array $fields
     * @return array
     */
    public function delete($uri, array $fields);
}