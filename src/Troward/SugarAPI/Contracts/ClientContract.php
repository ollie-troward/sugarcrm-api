<?php namespace Troward\SugarAPI\Contracts;

/**
 * Interface ClientContract
 * @package Troward\SugarAPI\Contracts
 */
interface ClientContract {
    /**
     * Sends a GET Request
     *
     * @param $uri
     * @param array $fields
     * @return array
     */
    public function getRequest($uri, array $fields);

    /**
     * Sends a POST Request
     *
     * @param $uri
     * @param array $fields
     * @return array
     */
    public function postRequest($uri, array $fields);

    /**
     * Sends a PUT Request
     *
     * @param $uri
     * @param array $fields
     * @return array
     */
    public function putRequest($uri, array $fields);

    /**
     * Sends a DELETE Request
     *
     * @param $uri
     * @param array $fields
     * @return array
     */
    public function deleteRequest($uri, array $fields);
}