<?php namespace spec\Troward\SugarAPI\Modules;

use spec\Troward\SugarAPI\BaseSpec;

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
    protected $limit = 10;

    /**
     * The module class.
     *
     * @var string
     */
    protected $module = "Troward\\SugarAPI\\Modules\\Account";

    /**
     * The result class.
     *
     * @var string
     */
    protected $result = "Troward\\SugarAPI\\Result";

    /**
     * A valid record id.
     *
     * @var string
     */
    protected $validRecordId;

    /**
     * A valid record name.
     *
     * @var string
     */
    protected $validRecordName;

    /**
     *
     */
    function __construct()
    {
        parent::__construct();
        $this->validRecordId = getenv('valid_account_id');
        $this->validRecordName = getenv('valid_account_name');
    }

    /**
     * Check if the class can be initialised
     *
     * @return void
     */
    function it_is_initializable()
    {
        $this->shouldHaveType($this->module);
    }

    /**
     * Retrieve all records via all() | get()
     */
    function it_retrieves_all_records()
    {
        $this->all($this->limit)->shouldReturnAnInstanceOf($this->result);
        $this->get($this->limit)->shouldReturnAnInstanceOf($this->result);
    }

    /**
     * Retrieve the first record
     */
    function it_retrieves_the_first_record()
    {
        $this->find('id', $this->validRecordId)->shouldReturnAnInstanceOf($this->module);
    }

    /**
     * Fails to retrieve any record
     */
    function it_fails_to_retrieve_any_records()
    {
        $this->find('id', 'not_valid_id')->shouldReturnAnInstanceOf($this->result);
    }

    /**
     * Allows filtering
     */
    function it_allows_multiple_filters_and_returns_a_record()
    {
        $this->where('name', $this->validRecordName)
            ->where('id', $this->validRecordId)
            ->get()
            ->shouldReturnAnInstanceOf($this->result);
    }

    /**
     * You can subscribe to a record
     */
    function it_can_subscribe_to_a_record()
    {
        $this->find('id', $this->validRecordId)
            ->subscribe()
            ->shouldReturn(true);
    }

    /**
     * You can unsubscribe to a record
     */
    function it_can_unsubscribe_to_a_record()
    {
        $this->find('id', $this->validRecordId)
            ->unsubscribe()
            ->shouldReturn(true);
    }

    /**
     * You can favourite to a record
     */
    function it_can_favourite_to_an_record()
    {
        $this->find('id', $this->validRecordId)
            ->favorite()
            ->shouldReturn(true);
    }

    /**
     * You can unfavourite to a record
     */
    function it_can_unfavourite_to_a_record()
    {
        $this->find('id', $this->validRecordId)
            ->unfavorite()
            ->shouldReturn(true);
    }
}
