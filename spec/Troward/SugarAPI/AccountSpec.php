<?php namespace spec\Troward\SugarAPI;

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
        $this->find('id', 'valid_id')->shouldHaveCount(1);
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
        $this->where('name', 'valid_account_name')->where('id', 'valid_id')->get()->shouldNotHaveCount(0);
    }

    /**
     * Creates a new record
     */
    function it_creates_a_new_account()
    {
        // $this->create(['name' => 'new_name', 'description' => 'new_description'])->shouldHaveCount(1);
    }

    /**
     * Updates an existing record
     */
    function it_updates_an_existing_account()
    {
        // $this->update('existing_id', ['name' => 'new_name'])->shouldHaveCount(1);
    }

    /**
     * Deletes an existing record
     */
    function it_deletes_an_existing_account()
    {
        // $this->delete('existing_id')->shouldHaveCount(1);
    }
}
