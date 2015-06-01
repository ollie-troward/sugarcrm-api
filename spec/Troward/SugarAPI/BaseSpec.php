<?php namespace spec\Troward\SugarAPI;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Troward\SugarAPI\Config;
use Troward\SugarAPI\Token;

/**
 * Class BaseSpec
 * @package spec\Troward\SugarAPI
 */
class BaseSpec extends ObjectBehavior {

    /**
     * @var
     */
    protected $token;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var array
     */
    protected $credentials;

    /**
     *
     */
    function __construct()
    {
        $this->credentials = [
            'url' => getenv('url'),
            'username' => getenv('username'),
            'password' => getenv('password'),
            'consumer_key' => getenv('consumer_key'),
            'consumer_secret' => getenv('consumer_secret'),
        ];

        $this->it_needs_the_configuration_to_be_set();

        $this->it_needs_a_token();
    }

    /**
     *
     */
    function it_needs_the_configuration_to_be_set()
    {
        new Config(
            $this->credentials['url'],
            $this->credentials['username'], $this->credentials['password'],
            $this->credentials['consumer_key'], $this->credentials['consumer_secret']
        );
    }

    /**
     *
     */
    protected function it_needs_a_token()
    {
        $this->token = Token::retrieve();
    }
}