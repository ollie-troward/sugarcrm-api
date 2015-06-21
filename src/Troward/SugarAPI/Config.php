<?php namespace Troward\SugarAPI;

use Troward\SugarAPI\Contracts\ConfigContract;

/**
 * Class Config
 * @package Troward\SugarAPI
 */
class Config implements ConfigContract
{
    /**
     * @var static $url
     */
    private static $url;

    /**
     * @var static $username
     */
    private static $username;

    /**
     * @var static $password
     */
    private static $password;

    /**
     * @var static $consumerKey
     */
    private static $consumerKey;

    /**
     * @var static $consumerSecret
     */
    private static $consumerSecret;

    /**
     * @param $url
     * @param $username
     * @param $password
     * @param $consumerKey
     * @param $consumerSecret
     */
    function __construct($url, $username, $password, $consumerKey, $consumerSecret)
    {
        $this->setUrl($url);
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setConsumerKey($consumerKey);
        $this->setConsumerSecret($consumerSecret);
    }

    /**
     * @return static
     */
    public static function get()
    {
        static $config = null;

        if (null === $config)
        {
            $config = new static(static::getUrl(), static::getUsername(), static::getPassword(), static::getConsumerKey(), static::getConsumerSecret());
        }

        return $config;
    }

    /**
     * @return string
     */
    public static function getUrl()
    {
        return static::$url;
    }

    /**
     * @param string $url
     * @return void
     */
    public function setUrl($url)
    {
        static::$url = $url;
    }

    /**
     * @return string
     */
    public static function getUsername()
    {
        return static::$username;
    }

    /**
     * @param string $username
     * @return void
     */
    public function setUsername($username)
    {
        static::$username = $username;
    }

    /**
     * @return string
     */
    public static function getPassword()
    {
        return static::$password;
    }

    /**
     * @param string $password
     * @return void
     */
    public function setPassword($password)
    {
        static::$password = $password;
    }


    /**
     * @return mixed
     */
    public static function getConsumerKey()
    {
        return static::$consumerKey;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function setConsumerKey($key)
    {
        static::$consumerKey = $key;
    }

    /**
     * @return mixed
     */
    public static function getConsumerSecret()
    {
        return static::$consumerSecret;
    }

    /**
     * @param $secret
     * @return mixed
     */
    public function setConsumerSecret($secret)
    {
        static::$consumerSecret = $secret;
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     */
    private function __clone()
    {
    }
}