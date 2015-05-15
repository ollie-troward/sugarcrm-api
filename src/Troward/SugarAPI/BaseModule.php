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
     * @var
     */
    public $fields;

    /**
     * @param $fields
     */
    function __construct($fields = [])
    {
        parent::__construct();
        $this->fields = $fields;
    }

    /**
     * @param int $limit
     * @param array $fields
     * @param array $orderBy
     * @return mixed
     */
    public function all($limit = 500, $fields = [], $orderBy = [])
    {
        return $this->getAll($this->module, $limit, $fields, $orderBy);
    }

    /**
     * @param $key
     * @param $value
     * @param array $fields
     * @return mixed
     */
    public function find($key, $value, $fields = [])
    {
        return $this->getFirst($this->module, [$key => $value], $fields);
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

    /**
     * @param int $limit
     * @param array $fields
     * @param $orderBy
     * @return mixed
     */
    public function get($limit = 500, $fields = [], $orderBy = [])
    {
        return $this->getAll($this->module, $limit, $fields, $orderBy);
    }

    /**
     * @param array $fields
     * @return mixed
     */
    public function create(array $fields)
    {
        $fields = array_merge($this->fields, $fields);

        return $this->post($this->module, $fields);
    }

    /**
     * @param array $id
     * @param array $fields
     * @return mixed
     */
    public function update($id, array $fields)
    {
        $fields = array_merge($this->fields, $fields);

        return $this->put($this->module, $id, $fields);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->deleteById($this->module, $id);
    }
}