<?php namespace Troward\SugarAPI;

use Troward\SugarAPI\Contracts\BaseModuleContract;

/**
 * Class BaseModule
 * @package Troward\SugarAPI
 */
class BaseModule extends Module implements BaseModuleContract {

    /**
     * Filters appended.
     *
     * @var array
     */
    protected $filters;

    /**
     * Fields included for creating a new record.
     *
     * @var array
     */
    protected $fields;

    /**
     * Fields included for creating a new record.
     *
     * @param array $fields
     */
    function __construct($fields = [])
    {
        parent::__construct();

        $this->fields = $fields;

        $this->setModuleProperties($fields);
    }

    /**
     * Returns all records
     *
     * @param int $limit
     * @param array $fields
     * @param array $orderBy
     * @return array
     */
    public function all($limit = 500, $fields = [], $orderBy = [])
    {
        $results = $this->getAll($this->module, $limit, $fields, $orderBy);

        return new Result($this, $results);
    }

    /**
     * Returns all records based on existing filters
     *
     * @param int $limit
     * @param array $fields
     * @param array $orderBy
     * @return array
     */
    public function get($limit = 500, $fields = [], $orderBy = [])
    {
        $results = $this->getAll($this->module, $limit, $fields, $orderBy);

        return new Result($this, $results);
    }

    /**
     * Creates a new record
     *
     * @param array $fields
     * @return array
     */
    public function create(array $fields)
    {
        $fields = array_merge($this->fields, $fields);

        $result = $this->post($this->module, $fields);

        if (empty($result)) return new Result($this, $result);

        $this->setModuleProperties($result[0]);

        return $this;
    }

    /**
     * Updates an existing record based on 'id'
     *
     * @param $id
     * @param array $fields
     * @return array
     */
    public function update($id, array $fields)
    {
        $fields = array_merge($this->fields, $fields);

        $result = $this->put($this->module, $id, $fields);

        if (empty($result)) return new Result($this, $result);

        $this->setModuleProperties($result[0]);

        return $this;
    }

    /**
     * Deletes an existing record based on 'id'
     *
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        return $this->deleteById($this->module, $id);
    }

    /**
     * Finds the first record
     *
     * @param $key
     * @param $value
     * @param array $fields
     * @return $this
     */
    public function find($key, $value, $fields = [])
    {
        $results = $this->getFirst($this->module, [$key => $value], $fields);

        if (empty($results)) return new Result($this, $results);

        $this->setModuleProperties($results[0]);

        return $this;
    }

    /**
     * Appends a filter to the query
     *
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
     * @return bool
     */
    public function favorite()
    {
        $this->moduleExists();

        $this->put($this->module, $this->id, [], __FUNCTION__);

        return true;
    }

    /**
     * @return bool
     */
    public function unfavorite()
    {
        $this->moduleExists();

        $this->put($this->module, $this->id, [], __FUNCTION__);

        return true;
    }

    /**
     * @return bool
     */
    public function subscribe()
    {
        $this->moduleExists();

        $this->postWithId($this->module, $this->id, [], __FUNCTION__);

        return true;
    }

    /**
     * @return bool
     */
    public function unsubscribe()
    {
        $this->moduleExists();

        $this->deleteById($this->module, $this->id, __FUNCTION__);

        return true;
    }
}