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

    function __construct($url, $username, $password)
    {
        $this->url = $url;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @param $url
     * @return mixed
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @param $username
     * @return mixed
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param $password
     * @return mixed
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }


}