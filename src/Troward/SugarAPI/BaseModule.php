<?php namespace Troward\SugarAPI;

use Troward\SugarAPI\Contracts\BaseModuleContract;

/**
 * Class BaseModule
 * @package Troward\SugarAPI
 */
class BaseModule extends Module implements BaseModuleContract {

    /**
     * @var array
     */
    protected $filters;

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

    /**
     * @param $key
     * @param $value
     * @param array $fields
     * @return mixed
     */
    public function find($key, $value, $fields = [])
    {
        return $this->retrieveFirst($this->module, [$key => $value], $fields);
    }

    /**
     * @param int $limit
     * @param array $fields
     * @param $orderBy
     * @return mixed
     */
    public function get($limit = 500, $fields = [], $orderBy = [])
    {
        return $this->retrieve($this->module, $limit, $fields, $orderBy);
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function where($key, $value)
    {
        if (empty($filters)) $this->filters = ['$and' => []];

        $this->filters['$and'][] = [$key => $value];

        return $this;
    }
}