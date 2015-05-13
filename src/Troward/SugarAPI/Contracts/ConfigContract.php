<?php namespace Troward\SugarAPI\Contracts;

/**
 * Interface ConfigContract
 * @package Troward\SugarAPI\Contracts
 */
interface ConfigContract {
    /**
     * @param $url
     * @return mixed
     */
    public function setUrl($url);

    /**
     * @param $username
     * @return mixed
     */
    public function setUsername($username);

    /**
     * @param $password
     * @return mixed
     */
    public function setPassword($password);
}