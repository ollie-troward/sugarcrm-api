<?php namespace spec\Troward\SugarAPI;

use Troward\SugarAPI\Account;

/**
 * Class AccountSpec
 * @package spec\Troward\SugarAPI
 */
class AccountSpec extends BaseSpec {

    /**
     * @var int
     */
    protected $limit = 50;

    /**
     *
     */
    function it_is_initializable()
    {
        $this->shouldHaveType('Troward\SugarAPI\Account');
    }

    /**
     *
     */
    function it_retrieves_all_accounts()
    {
        $this->all($this->limit, [], []);
    }

    /**
     *
     */
    function it_retrieves_the_first_account()
    {
        $this->find('id', 'valid_id')->shouldHaveCount(1);
    }

    /**
     *
     */
    function it_fails_to_retrieve_any_accounts()
    {
        $this->find('id', 'not_valid_id')->shouldHaveCount(0);
    }

    /**
     *
     */
    function it_allows_multiple_filters()
    {
        $this->where('name', 'valid_account_name')->get();
    }
}
