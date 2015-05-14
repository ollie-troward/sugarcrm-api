<?php namespace Troward\SugarAPI;

use Troward\SugarAPI\Contracts\ModuleContract;

class Account extends Module implements ModuleContract {

    /**
     * @var string
     */
    private $module = "Accounts";

    /**
     * @param int $limit
     * @return mixed
     */
    public function all($limit = 500)
    {
        return $this->retrieve($this->module, $limit);
    }
}