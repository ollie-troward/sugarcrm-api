<?php namespace Troward\SugarAPI;

use Troward\SugarAPI\Contracts\ModuleContract;

class Account extends Module implements ModuleContract {

    /**
     * @var string
     */
    private $module = "Accounts";

    /**
     * @param int $limit
     * @param array $fields
     * @param array $orderBy
     * @return mixed
     */
    public function all($limit = 500, $fields = [], $orderBy = [])
    {
        return $this->retrieve($this->module, $limit, $fields, $orderBy);
    }
}