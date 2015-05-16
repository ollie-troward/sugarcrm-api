<?php namespace spec\Troward\SugarAPI;

/**
 * Class ContactSpec
 * @package spec\Troward\SugarAPI
 */
class ContactSpec extends BaseSpec {

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
        $this->shouldHaveType('Troward\SugarAPI\Contact');
    }

    /**
     * Retrieve all records via all() | get()
     */
    function it_retrieves_all_contacts()
    {
        $this->all($this->limit)->shouldNotHaveCount(0);
        $this->get($this->limit)->shouldNotHaveCount(0);
    }

    /**
     * Retrieve the first record
     */
    function it_retrieves_the_first_contact()
    {
        $this->find('id', getenv('valid_contact_id'))->shouldHaveCount(1);
    }

    /**
     * Fails to retrieve any record
     */
    function it_fails_to_retrieve_any_contacts()
    {
        $this->find('id', 'not_valid_id')->shouldHaveCount(0);
    }

    /**
     * Allows filtering
     */
    function it_allows_multiple_filters_and_returns_a_contact()
    {
        $this->where('first_name', getenv('valid_contact_first_name'))
            ->where('last_name', getenv('valid_contact_last_name'))
            ->where('id', getenv('valid_contact_id'))
            ->get()->shouldNotHaveCount(0);
    }
}
