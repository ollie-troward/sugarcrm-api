<?php namespace spec\Troward\SugarAPI;

use Troward\SugarAPI\GuzzleRequest;
use Troward\SugarAPI\Parameter;

/**
 * Class TokenSpec
 * @package spec\Troward\SugarAPI
 */
class TokenSpec extends BaseSpec
{
    /**
     * It can be initialized
     */
    function it_is_initializable()
    {
        $this->shouldHaveType('Troward\SugarAPI\Token');
    }

    /**
     * It requires the config, a request client and parameter builder
     */
    function let()
    {
        $this->beConstructedWith($this->config, new GuzzleRequest($this->config), new Parameter);
    }

    /**
     * It should create a new Access Token
     */
    function it_should_create_a_new_access_token()
    {
        $this->make()
            ->shouldReturnAnInstanceOf('Troward\SugarAPI\Token');
    }

    /**
     * It should destroy the token and session
     */
    function it_should_destroy_the_session()
    {
        $this->make()
            ->shouldReturnAnInstanceOf('Troward\SugarAPI\Token');

        $this->destroy()
            ->shouldReturnAnInstanceOf('GuzzleHttp\Message\Response');
    }

}
