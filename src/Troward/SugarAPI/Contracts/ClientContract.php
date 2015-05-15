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
    public function getRequest($uri, array $parameters, $token = null);

    /**
     * @param $uri
     * @param array $parameters
     * @param null $token
     * @return array
     */
    public function postRequest($uri, array $parameters, $token = null);

    /**
     * @param $uri
     * @param array $parameters
     * @param null $token
     * @return array
     */
    public function putRequest($uri, array $parameters, $token = null);

    /**
     * @param $uri
     * @param null $token
     * @return array
     */
    public function deleteRequest($uri, $token = null);
}