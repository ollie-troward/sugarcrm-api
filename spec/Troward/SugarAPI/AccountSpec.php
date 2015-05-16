<?php namespace spec\Troward\SugarAPI;
use Troward\SugarAPI\Account;

/**
 * Class AccountSpec
 * @package spec\Troward\SugarAPI
 */
class AccountSpec extends BaseSpec {

    /**
     * The limit of records to be retrieved.
     *
     * @var int
     */
    protected $limit = 50;

    /**
     * Check if the class can be initialised
     *
     * @return void
     */
    function it_is_initializable()
    {
        $this->shouldHaveType('Troward\SugarAPI\Account');
    }

    /**
     * Retrieve all records via all() | get()
     */
    function it_retrieves_all_accounts()
    {
        $this->all($this->limit)->shouldNotHaveCount(0);
        $this->get($this->limit)->shouldNotHaveCount(0);
    }

    /**
     * Retrieve the first record
     */
    function it_retrieves_the_first_account()
    {
        $this->find('id', getenv('valid_account_id'))->shouldReturnAnInstanceOf('Troward\SugarAPI\Account');
    }

    /**
     * Fails to retrieve any record
     */
    function it_fails_to_retrieve_any_accounts()
    {
        $this->find('id', 'not_valid_id')->shouldHaveCount(0);
    }

    /**
     * Allows filtering
     */
    function it_allows_multiple_filters_and_returns_an_account()
    {
        $this->where('name', getenv('valid_account_name'))->where('id', getenv('valid_account_id'))->get()->shouldNotHaveCount(0);
    }

    /**
     * You can subscribe to an account
     */
    function it_can_subscribe_to_an_account()
    {
        $this->find('id', getenv('valid_account_id'))->subscribe();
    }

    /**
     * You can unsubscribe to an account
     */
    function it_can_unsubscribe_to_an_account()
    {
        $this->find('id', getenv('valid_account_id'))->unsubscribe();
    }

    /**
     * You can favourite to an account
     */
    function it_can_favourite_to_an_account()
    {
        $this->find('id', getenv('valid_account_id'))->favorite();
    }

    /**
     * You can unfavourite to an account
     */
    function it_can_unfavourite_to_an_account()
    {
        $this->find('id', getenv('valid_account_id'))->unfavorite();
    }
}
