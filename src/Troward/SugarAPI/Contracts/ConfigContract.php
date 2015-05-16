<?php namespace Troward\SugarAPI\Contracts;

/**
 * Interface ConfigContract
 * @package Troward\SugarAPI\Contracts
 */
interface ConfigContract {

    /**
     * Returns Singleton instance of Config
     *
     * @return static
     */
    public static function get();

    /**
     * Returns the current $url
     *
     * @return string
     */
    public static function getUrl();

    /**
     * Sets a new $url
     *
     * @param $url
     * @return void
     */
    public function setUrl($url);

    /**
     * Returns the current $username
     *
     * @return string
     */
    public static function getUsername();

    /**
     * Sets a new $username
     *
     * @param $username
     * @return void
     */
    public function setUsername($username);

    /**
     * Returns the current $password
     *
     * @return string
     */
    public static function getPassword();

    /**
     * Sets a new $password
     *
     * @param $password
     * @return void
     */
    public function setPassword($password);

    /**
     * Returns the current $consumerKey
     *
     * @return string
     */
    public static function getConsumerKey();

    /**
     * Sets a new $consumerKey
     *
     * @param $key
     * @return void
     */
    public function setConsumerKey($key);

    /**
     * Returns the current $consumerSecret
     *
     * @return string
     */
    public static function getConsumerSecret();

    /**
     * Sets a new $consumerSecret
     *
     * @param $secret
     * @return void
     */
    public function setConsumerSecret($secret);
}