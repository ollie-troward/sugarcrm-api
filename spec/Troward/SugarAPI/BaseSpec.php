<?php namespace spec\Troward\SugarAPI;

use Dotenv\Dotenv;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Troward\SugarAPI\Config;
use Troward\SugarAPI\GuzzleRequest;
use Troward\SugarAPI\Parameter;
use Troward\SugarAPI\Token;

/**
 * Class BaseSpec
 * @package spec\Troward\SugarAPI
 */
class BaseSpec extends ObjectBehavior
{
    /**
     * @var array
     */
    protected $credentials;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var Token
     */
    protected $token;

    /**
     * @var GuzzleRequest
     */
    protected $request;

    /**
     * @var
     */
    protected $parameters;

    /**
     *
     */
    function __construct()
    {
        $dotenv = new Dotenv(__DIR__ . '/../../../');
        $dotenv->load();

        $this->credentials = [
            'url' => getenv('URL'),
            'username' => getenv('USERNAME'),
            'password' => getenv('PASSWORD'),
            'consumer_key' => getenv('CONSUMER_KEY'),
            'consumer_secret' => getenv('CONSUMER_SECRET'),
        ];

        $this->it_needs_the_configuration_to_be_set();
        $this->it_needs_a_token();
        $this->it_needs_a_request_dependency();
        $this->it_needs_a_parameter_builder();
    }

    /**
     *
     */
    function it_needs_the_configuration_to_be_set()
    {
        $this->config = new Config(
            $this->credentials['url'],
            $this->credentials['username'], $this->credentials['password'],
            $this->credentials['consumer_key'], $this->credentials['consumer_secret']
        );
    }

    /**
     *
     */
    function it_needs_a_token()
    {
        $this->token = new Token($this->config, new GuzzleRequest($this->config), new Parameter);
    }

    /**
     *
     */
    function it_needs_a_request_dependency()
    {
        $this->request = new GuzzleRequest($this->config, $this->token);
    }

    /**
     *
     */
    function it_needs_a_parameter_builder()
    {
        $this->parameters = new Parameter($this->token);
    }
}