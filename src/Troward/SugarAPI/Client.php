<?php namespace Troward\SugarAPI;

/**
 * Class Client
 * @package Troward\SugarAPI
 */
class Client implements ClientInterface
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var Token
     */
    private $token;

    /**
     * @var Client
     */
    private $request;

    /**
     * @var Parameter
     */
    private $parameters;

    /**
     * @param Config $config
     */
    function __construct(Config $config)
    {
        $this->config = $config;
        $this->token = $this->makeToken(new GuzzleRequest($this->config), new Parameter);
        $this->request = new GuzzleRequest($this->config, $this->token);
        $this->parameters = new Parameter($this->token);
    }

    /**
     * Since we haven't been authenticated yet, every time a new Client has be instantiated we need a valid token request
     *
     * @param RequestInterface $request
     * @param ParameterInterface $parameters
     * @return Token
     */
    private function makeToken(RequestInterface $request, ParameterInterface $parameters)
    {
        return new Token($this->config, $request, $parameters);
    }

    /**
     * Access to Module end points
     *
     * @param $name
     * @return Module
     */
    public function module($name)
    {
        return new Module($name, $this->request, $this->parameters);
    }

    /**
     * Access to Other end points
     *
     * @return Other
     */
    public function other()
    {
        return new Other($this->request, $this->parameters);
    }

    /**
     * Retrieves the current token
     *
     * @return Token
     */
    public function token()
    {
        return $this->token;
    }

    /**
     * Getter for config
     *
     * @return Config
     */
    public function config()
    {
        return $this->config;
    }
}