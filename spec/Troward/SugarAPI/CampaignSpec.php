<?php namespace spec\Troward\SugarAPI;

/**
 * Class CampaignSpec
 * @package spec\Troward\SugarAPI
 */
class CampaignSpec extends BaseSpec {

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
        $this->shouldHaveType('Troward\SugarAPI\Campaign');
    }

    /**
     * Retrieve all records via all() | get()
     */
    function it_retrieves_all_campaigns()
    {
        $this->all($this->limit)->shouldNotHaveCount(0);
        $this->get($this->limit)->shouldNotHaveCount(0);
    }

    /**
     * Retrieve the first record
     */
    function it_retrieves_the_first_campaign()
    {
        $this->find('id', getenv('valid_campaign_id'))->shouldHaveCount(1);
    }

    /**
     * Fails to retrieve any record
     */
    function it_fails_to_retrieve_any_campaigns()
    {
        $this->find('id', 'not_valid_id')->shouldHaveCount(0);
    }

    /**
     * Allows filtering
     */
    function it_allows_multiple_filters_and_returns_a_campaign()
    {
        $this->where('name', getenv('valid_campaign_name'))
            ->where('id', getenv('valid_campaign_id'))
            ->get()->shouldNotHaveCount(0);
    }
}
