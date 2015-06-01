<?php namespace Troward\SugarAPI;

use Troward\SugarAPI\Contracts\TokenContract;

/**
 * Class Token
 * @package Troward\SugarAPI
 */
class Token extends Client implements TokenContract {

    /**
     * @var $access_token string
     */
    private $access_token;

    /**
     * @var $expires_in string
     */
    private $expires_in;

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

        $newToken = $this->postRequest($this->loginUri, $this->buildTokenParameters());

        $this->setProperties($newToken->json());

        return $this;
    }

    /**
     * @param array $newToken
     */
    private function setProperties(array $newToken)
    {
        $this->access_token = $newToken['access_token'];
        $this->expires_in = $newToken['expires_in'];
    }

    /**
     * @return true
     */
    public function destroy()
    {
        if (!empty($this->access_token))
        {
            $this->postRequest($this->logoutUri, $this->buildParameters(0, [], [], [], $this));
        }

        return true;
    }


    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * @return string
     */
    public function getExpiresIn()
    {
        return $this->expires_in;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->access_token;
    }
}