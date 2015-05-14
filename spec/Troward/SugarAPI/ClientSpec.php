<?php namespace spec\Troward\SugarAPI;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ClientSpec
 * @package spec\Troward\SugarAPI
 */
class ClientSpec extends ObjectBehavior {

    /**
     *
     */
    function it_is_initializable()
    {
        $this->shouldHaveType('Troward\SugarAPI\Client');
    }
}
