<?php namespace Troward\SugarAPI;

/**
 * Class Config
 * @package Troward\SugarAPI
 */
class Config
{
    /**
     * @var $url
     */
    private $url;

    /**
     * @var $username
     */
    private $username;

    /**
     * @var $password
     */
    private $password;

    /**
     * @var $consumerKey
     */
    private $consumerKey;

    /**
     * @var $consumerSecret
     */
    private $consumerSecret;

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
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return void
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return void
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getConsumerKey()
    {
        return $this->consumerKey;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function setConsumerKey($key)
    {
        $this->consumerKey = $key;
    }

    /**
     * @return mixed
     */
    public function getConsumerSecret()
    {
        return $this->consumerSecret;
    }

    /**
     * @param $secret
     * @return mixed
     */
    public function setConsumerSecret($secret)
    {
        $this->consumerSecret = $secret;
    }
}