<?php namespace Troward\SugarAPI;

use Troward\SugarAPI\Contracts\ModuleContract;

class Module extends Client implements ModuleContract {

    /**
     * @var name
     */
    private $name;

    /**
     * @param $name
     */
    function __construct($name = null)
    {
        parent::__construct();
        $this->name = $name;
    }

    /**
     * @return static
     */
    private function token()
    {
        return Token::retrieve();
    }

    /**
     * @param $module
     * @param $limit
     * @return mixed
     */
    public function retrieve($module, $limit)
    {
        return $this->get($module, ['max_num' => $limit], $this->token())['records'];
    }

}