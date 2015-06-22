<?php namespace Troward\SugarAPI;

use Troward\SugarAPI\Contracts\TokenContract;

/**
 * Class Token
 * @package Troward\SugarAPI
 */
class Token
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ParameterInterface
     */
    private $parameters;

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
     * @param Config $config
     * @param RequestInterface $request
     * @param ParameterInterface $parameters
     */
    function __construct(Config $config, RequestInterface $request, ParameterInterface $parameters)
    {
        $this->config = $config;
        $this->request = $request;
        $this->parameters = $parameters;
        $this->make();
    }

    /**
     * @return $this
     */
    public function make()
    {
        $newToken = $this->request->post($this->loginUri, $this->parameters->newToken($this->config));

        $newToken = new Result($newToken);

        $this->setProperties($newToken);

        $this->parameters->setToken($this);

        return $this;
    }

    /**
     * @param $newToken
     * @return void
     */
    private function setProperties($newToken)
    {
        $this->access_token = $newToken['access_token'];
        $this->expires_in = $newToken['expires_in'];
    }

    /**
     * @return Result
     */
    public function destroy()
    {
        return $this->request->post($this->logoutUri, $this->parameters->tokenOnly());
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