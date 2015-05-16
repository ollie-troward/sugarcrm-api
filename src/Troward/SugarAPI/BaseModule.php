<?php namespace Troward\SugarAPI;

use Troward\SugarAPI\Contracts\BaseModuleContract;
use Troward\SugarAPI\Exceptions\ClientException;

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
    public $fields;

    /**
     * Fields included for creating a new record.
     *
     * @param array $fields
     */
    function __construct($fields = [])
    {
        parent::__construct();
        $this->fields = $fields;
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
        return $this->getAll($this->module, $limit, $fields, $orderBy);
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
        return $this->getAll($this->module, $limit, $fields, $orderBy);
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

        return $this->post($this->module, $fields);
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

        return $this->put($this->module, $id, $fields);
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

        if (empty($results)) return $results;

        return $this->setModuleProperties($results[0]);
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