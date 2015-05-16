<?php namespace spec\Troward\SugarAPI;

/**
 * Class NoteSpec
 * @package spec\Troward\SugarAPI
 */
class NoteSpec extends BaseSpec {

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
        $this->shouldHaveType('Troward\SugarAPI\Note');
    }

    /**
     * Retrieve all records via all() | get()
     */
    function it_retrieves_all_notes()
    {
        $this->all($this->limit)->shouldNotHaveCount(0);
        $this->get($this->limit)->shouldNotHaveCount(0);
    }

    /**
     * Retrieve the first record
     */
    function it_retrieves_the_first_note()
    {
        $this->find('id', getenv('valid_note_id'))->shouldHaveCount(1);
    }

    /**
     * Fails to retrieve any record
     */
    function it_fails_to_retrieve_any_notes()
    {
        $this->find('id', 'not_valid_id')->shouldHaveCount(0);
    }

    /**
     * Allows filtering
     */
    function it_allows_multiple_filters_and_returns_a_note()
    {
        $this->where('name', getenv('valid_note_name'))
            ->where('id', getenv('valid_note_id'))
            ->get()->shouldNotHaveCount(0);
    }
}
