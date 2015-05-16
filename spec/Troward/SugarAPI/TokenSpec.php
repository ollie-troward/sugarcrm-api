<?php namespace spec\Troward\SugarAPI;

/**
 * Class TokenSpec
 * @package spec\Troward\SugarAPI
 */
class TokenSpec extends BaseSpec {

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
    function it_creates_the_current_instance_token()
    {
        $this->retrieve()->shouldHaveType('Troward\SugarAPI\Token');
    }

    /**
     *
     */
    function it_should_return_the_current_access_token()
    {
        $this->make()->shouldBeArray();
    }

    /**
     *
     */
    function it_should_destroy_the_session()
    {
        $this->destroy()->shouldReturn(true);
    }

}
