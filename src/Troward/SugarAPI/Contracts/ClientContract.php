<?php namespace Troward\SugarAPI\Contracts;

/**
 * Interface ClientContract
 * @package Troward\SugarAPI\Contracts
 */
interface ClientContract {
    /**
     * @param $uri
     * @param array $parameters
     * @return array
     */
    public function get($uri, array $parameters);

    /**
     * @param $uri
     * @param $parameters
     * @return array
     */
    public function post($uri, array $parameters);

    /**
     * @param $uri
     * @param array $parameters
     * @return array
     */
    public function put($uri, array $parameters);

    /**
     * @param $uri
     * @param array $parameters
     * @return array
     */
    public function delete($uri, array $parameters);
}