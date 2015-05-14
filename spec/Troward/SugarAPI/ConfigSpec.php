<?php namespace spec\Troward\SugarAPI;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Troward\SugarAPI\Config;

class ConfigSpec extends ObjectBehavior {

    private $config;

    function it_is_initializable()
    {
        $this->config = new Config('','','','','');
    }

    function it_should_keep_state_and_return_the_configuration_details()
    {
        //
    }
}
