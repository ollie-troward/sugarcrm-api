<?php namespace Troward\SugarAPI\Contracts;

/**
 * Interface ClientContract
 * @package Troward\SugarAPI\Contracts
 */
interface ClientContract
{
    /**
     * Builds the HTTP Request Parameters
     *
     * @param $limit
     * @param array $filters
     * @param array $fields
     * @param array $orderBy
     * @param TokenContract $token
     * @return array
     */
    public function buildParameters($limit, array $filters, array $fields, array $orderBy, TokenContract $token);

    /**
     * Builds the necessary File Parameters for an Upload
     *
     * @param $sourcePath
     * @param TokenContract $token
     * @return array
     */
    public function buildFileParameters($sourcePath, TokenContract $token);

    /**
     * Builds the HTTP Token Request Parameters
     *
     * @return array
     */
    public function buildTokenParameters();

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