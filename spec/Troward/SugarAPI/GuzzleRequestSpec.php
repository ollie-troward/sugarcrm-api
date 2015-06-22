<?php namespace spec\Troward\SugarAPI;
use Troward\SugarAPI\Token;
use Troward\SugarAPI\GuzzleRequest;
use Troward\SugarAPI\Parameter;

/**
 * Class GuzzleRequestSpec
 * @package spec\Troward\SugarAPI
 */
class GuzzleRequestSpec extends BaseSpec
{
    /**
     *
     */
    function it_is_initializable()
    {
        $this->shouldHaveType('Troward\SugarAPI\GuzzleRequest');
    }

    function let()
    {
        $this->beConstructedWith($this->config, $this->token);
    }
}
