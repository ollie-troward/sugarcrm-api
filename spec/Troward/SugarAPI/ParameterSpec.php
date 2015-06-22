<?php namespace spec\Troward\SugarAPI;

class ParameterSpec extends BaseSpec
{
    /**
     *
     */
    function it_is_initializable()
    {
        $this->shouldHaveType('Troward\SugarAPI\Parameter');
    }

    function let()
    {
        $this->beConstructedWith($this->token);
    }
}