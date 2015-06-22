<?php namespace spec\Troward\SugarAPI;

/**
 * Class ClientSpec
 * @package spec\Troward\SugarAPI
 */
class ClientSpec extends BaseSpec
{
    /**
     * It can be initialized
     */
    function it_is_initializable()
    {
        $this->shouldHaveType('Troward\SugarAPI\Client');
    }

    /**
     * It needs to be constructed with Config
     */
    function let()
    {
        $this->beConstructedWith($this->config);
    }

    /**
     * It allows Module requests
     */
    function it_allows_module_requests()
    {
        $this->module('Accounts')
            ->shouldHaveType('Troward\SugarAPI\Module');
    }

    /**
     * It allows Non-Module specific requests
     */
    function it_allows_non_module_requests()
    {
        $this->other()
            ->shouldHaveType('Troward\SugarAPI\Other');
    }

    /**
     * It returns the current token
     */
    function it_returns_the_current_token()
    {
        $this->token()
            ->shouldHaveType('Troward\SugarAPI\Token');
    }

    /**
     * It returns the current config
     */
    function it_returns_the_current_config()
    {
        $this->config()
            ->shouldHaveType('Troward\SugarAPI\Config');
    }
}