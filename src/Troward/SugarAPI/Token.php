<?php namespace Troward\SugarAPI;

use Troward\SugarAPI\Contracts\TokenContract;

/**
 * Class Token
 * @package Troward\SugarAPI
 */
class Token extends Client implements TokenContract {

    /**
     * @var
     */
    private $token;

    /**
     * @var string
     */
    private $loginUri = "oauth2/token";

    /**
     * @var string
     */
    private $logoutUri = "oauth2/logout";

    /**
     *
     */
    function __construct()
    {
        parent::__construct();
        $this->make();
    }

    /**
     * @return static
     */
    public static function retrieve()
    {
        static $token = null;

        if (null === $token)
        {
            $token = new static;
        }

        return $token;
    }

    /**
     * @return string
     */
    public function make()
    {
        if (!empty($this->token)) return $this->token;

        $newToken = $this->postRequest($this->loginUri, $this->parameters());

        return $this->token = $newToken;
    }

    /**
     * @return true
     */
    public function destroy()
    {
        if (!empty($this->token)) $this->postRequest($this->logoutUri, [], $this->token['access_token']);

        return true;
    }

    /**
     * @return array
     */
    private function parameters()
    {
        return [
            "grant_type" => "password",
            "client_id" => $this->config->getConsumerKey(),
            "client_secret" => $this->config->getConsumerSecret(),
            "username" => $this->config->getUsername(),
            "password" => $this->config->getPassword(),
            "platform" => "base",
        ];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->token['access_token'];
    }
}