<?php namespace spec\Troward\SugarAPI;

/**
 * Class ClientSpec
 * @package spec\Troward\SugarAPI
 */
class ClientSpec extends BaseSpec {

    /**
     *
     */
    function it_is_initializable()
    {
        $this->shouldHaveType('Troward\SugarAPI\Client');
    }

    /**
     *
     */
    function it_runs_a_get_request_for_accounts()
    {
        $this->get('Accounts', [], $this->token);
    }

    /**
     *
     */
    function it_runs_a_post_request_for_a_token()
    {
        // TODO $this->post('oauth2/token', [], null);
    }
}
