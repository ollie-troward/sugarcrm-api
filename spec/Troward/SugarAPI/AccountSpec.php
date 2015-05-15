<?php namespace spec\Troward\SugarAPI;

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
    function it_retrieves_all_records_with_a_limit()
    {
        $this->all($this->limit, [], []);
    }
}
