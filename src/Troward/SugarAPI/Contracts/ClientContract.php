<?php namespace Troward\SugarAPI\Contracts;

/**
 * Interface ClientContract
 * @package Troward\SugarAPI\Contracts
 */
interface ClientContract {
    /**
     * @param $uri
     * @param array $parameters
     * @param null $token
     * @return array
     */
    public function get($uri, array $parameters, $token = null);

    /**
     * @param $uri
     * @param array $parameters
     * @param null $token
     * @return array
     */
    public function post($uri, array $parameters, $token = null);

    /**
     * @param $uri
     * @param array $parameters
     * @param null $token
     * @return array
     */
    public function put($uri, array $parameters, $token = null);

    /**
     * @param $uri
     * @param array $parameters
     * @param null $token
     * @return array
     */
    public function delete($uri, array $parameters, $token = null);
}