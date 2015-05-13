<?php namespace Troward\SugarAPI;

use Troward\SugarAPI\Contracts\ConfigContract;

class Config implements ConfigContract {
    /**
     * @var
     */
    private $url;
    /**
     * @var
     */
    private $username;
    /**
     * @var
     */
    private $password;

    /**
     * @var
     */
    private $consumerKey;

    /**
     * @var
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
        $this->url = $url;
        $this->username = $username;
        $this->password = $password;
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
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