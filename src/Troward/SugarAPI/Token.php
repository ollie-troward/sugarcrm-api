<?php namespace Troward\SugarAPI;

use Troward\SugarAPI\Contracts\TokenContract;

/**
 * Class Token
 * @package Troward\SugarAPI
 */
class Token implements TokenContract
{
    /**
     * @var GuzzleClient
     */
    protected $client;

    /**
     * @var Parameter
     */
    protected $parameters;

    /**
     * @var Config
     */
    protected $config;

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
        $this->client = new GuzzleClient;
        $this->parameters = new Parameter;
        $this->config = Config::get();
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

        $newToken = $this->client->post($this->loginUri, $this->parameters->token($this->config));

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
            $this->client->post($this->logoutUri, $this->parameters->none($this));
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