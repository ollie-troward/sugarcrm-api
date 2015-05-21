<?php namespace spec\Troward\SugarAPI;

use Troward\SugarAPI\Result;

/**
 * Class ResultSpec
 * @package spec\Troward\SugarAPI
 */
class ResultSpec extends BaseSpec {

    /**
     * @var array
     */
    protected $data =
        [
            0 => ['name' => 'Steve Account', 'description' => 'Steve Description'],
            1 => ['name' => 'John']
        ];

    /**
     * @var string
     */
    protected $module = "Troward\\SugarAPI\\Modules\\Account";

    /**
     *
     */
    function let()
    {
        $this->beConstructedWith(new $this->module, $this->data);
    }

    /**
     *
     */
    function it_is_initializable()
    {
        $this->shouldHaveType('Troward\SugarAPI\Result');
    }

    /**
     *
     * 
     * function it_should_contain_a_set_of_objects()
     * {
     * // TODO Check Result with Spec
     * } */
}
