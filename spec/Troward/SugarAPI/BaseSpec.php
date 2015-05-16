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
     *
     */
    function __construct()
    {
        $this->it_needs_the_configuration_to_be_set();
        $this->it_needs_a_token();
    }

    /**
     *
     */
    function it_needs_the_configuration_to_be_set()
    {
        new Config(getenv('url'), getenv('username'), getenv('password'), getenv('consumer_key'), getenv('consumer_secret'));
    }

    /**
     *
     */
    protected function it_needs_a_token()
    {
        $this->token = new Token();
    }
}