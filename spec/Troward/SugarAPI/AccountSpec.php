<?php

namespace spec\Troward\SugarAPI;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Troward\SugarAPI\Account;

/**
 * Class AccountSpec
 * @package spec\Troward\SugarAPI
 */
class AccountSpec extends ObjectBehavior {
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
        $account = new Account();
        $account->all();
    }
}
