<?php namespace spec\Troward\SugarAPI;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Troward\SugarAPI\Token;

/**
 * Class TokenSpec
 * @package spec\Troward\SugarAPI
 */
class TokenSpec extends ObjectBehavior {

    /**
     *
     */
    function it_is_initializable()
    {
        $this->shouldHaveType('Troward\SugarAPI\Token');
    }

    /**
     *
     */
    function it_has_a_set_config()
    {
    }

    /**
     *
     */
    function it_creates_a_new_token()
    {
        new Token();
    }

}
