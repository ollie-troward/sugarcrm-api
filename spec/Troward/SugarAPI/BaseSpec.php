<?php namespace spec\Troward\SugarAPI;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Yaml\Yaml;
use Troward\SugarAPI\Config;
use Troward\SugarAPI\Exceptions\ClientException;
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
        $this->config = $this->it_locates_and_parses_the_configuration();

        new Config(getenv('url'), getenv('username'), getenv('password'), getenv('consumer_key'), getenv('consumer_secret'));
    }

    /**
     * @return array
     */
    protected function it_locates_and_parses_the_configuration()
    {
        $file = @file_get_contents($this->location);

        if (!$file) throw new ClientException("Missing config.yml file for tests");

        return Yaml::parse($file);
    }

    /**
     *
     */
    protected function it_needs_a_token()
    {
        $this->token = new Token();
    }
}