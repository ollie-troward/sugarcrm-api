<?php namespace Troward\SugarAPI\Contracts;

/**
 * Interface ConfigContract
 * @package Troward\SugarAPI\Contracts
 */
interface ConfigContract {

    /**
     * @return static
     */
    public static function get();

    /**
     * @return string
     */
    public static function getUrl();

    /**
     * @param $url
     * @return void
     */
    public function setUrl($url);

    /**
     * @return string
     */
    public static function getUsername();

    /**
     * @param $username
     * @return void
     */
    public function setUsername($username);

    /**
     * @return string
     */
    public static function getPassword();

    /**
     * @param $password
     * @return void
     */
    public function setPassword($password);

    /**
     * @return string
     */
    public static function getConsumerKey();

    /**
     * @param $key
     * @return void
     */
    public function setConsumerKey($key);

    /**
     * @return string
     */
    public static function getConsumerSecret();

    /**
     * @param $secret
     * @return void
     */
    public function setConsumerSecret($secret);
}