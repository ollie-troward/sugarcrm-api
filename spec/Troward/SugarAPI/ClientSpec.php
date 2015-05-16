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
        $this->getRequest('Accounts', [], $this->token)->shouldNotHaveCount(0);
    }

    /**
     *
     */
    function it_runs_a_post_request_for_a_new_account()
    {
        // $this->postRequest('Accounts', ['name' => 'new_name'], null);
    }

    /**
     *
     */
    function it_runs_a_put_request_to_update_an_account()
    {
        // $this->putRequest('Account/valid_id', ['name' => 'new_name'], null);
    }

    /**
     *
     */
    function it_runs_a_delete_request_to_delete_an_account()
    {
        // $this->deleteRequest('Account/valid_id', [], null);
    }
}
