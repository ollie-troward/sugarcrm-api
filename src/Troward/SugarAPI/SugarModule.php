<?php namespace Troward\SugarAPI;

use Troward\SugarAPI\Contracts\SugarModuleContract;

/**
 * Class SugarModule
 * @package Troward\SugarAPI
 */
class SugarModule extends Client implements SugarModuleContract {

    /**
     * Name of the Module
     *
     * @var string
     */
    protected $module;

    /**
     * Filters for record query
     *
     * @var array
     */
    protected $filters = [];

    /**
     * @param string $module
     */
    function __construct($module)
    {
        parent::__construct();
        $this->module = $module;
    }

    /**
     * Retrieves the latest token
     *
     * @return Token
     */
    protected function token()
    {
        return Token::retrieve();
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
        $this->where($key, $value);

        return $this->get(1, $fields, []);
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
        return $this->getRequest($this->module, $this->buildParameters($limit, [], $fields, $orderBy, $this->token()));
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
        return $this->getRequest($this->module, $this->buildParameters($limit, $this->filters, $fields, $orderBy, $this->token()));
    }

    /**
     * Exports a record list
     *
     * @param $recordListId
     * @param int $limit
     * @param array $fields
     * @param array $orderBy
     * @return array
     */
    public function export($recordListId, $limit = 500, $fields = [], $orderBy = [])
    {
        return $this->getRequest($this->module . "/export/" . $recordListId, $this->buildParameters($limit, [], $fields, $orderBy, $this->token()));
    }

    /**
     * Creates a new record
     *
     * @param array $fields
     * @return array
     */
    public function create(array $fields)
    {
        return $this->postRequest($this->module, $this->buildParameters(0, [], $fields, [], $this->token()));
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
        return $this->putRequest($this->module . "/" . $id, $this->buildParameters(0, [], $fields, [], $this->token()));
    }

    /**
     * Deletes an existing record based on 'id'
     *
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        return $this->deleteRequest($this->module . "/" . $id, $this->buildParameters(0, [], [], [], $this->token()));
    }

    /**
     * Appends an AND filter to the query
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function where($key, $value)
    {
        $this->filters['$and'][] = [$key => $value];

        return $this;
    }

    /**
     * Appends an OR filter to the query
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function orWhere($key, $value)
    {
        $this->filters['$or'][] = [$key => $value];

        return $this;
    }

    /**
     * Favorite a record
     *
     * @param $id
     * @return bool
     */
    public function favorite($id)
    {
        return $this->putRequest($this->module . "/" . $id . "/" . __FUNCTION__, $this->buildParameters(0, [], [], [], $this->token()));
    }

    /**
     * Unfavorite a record
     *
     * @param $id
     * @return bool
     */
    public function unfavorite($id)
    {
        return $this->putRequest($this->module . "/" . $id . "/" . __FUNCTION__, $this->buildParameters(0, [], [], [], $this->token()));
    }

    /**
     * Subscribe to a record
     *
     * @param $id
     * @return bool
     */
    public function subscribe($id)
    {
        return $this->postRequest($this->module . "/" . $id . "/" . __FUNCTION__, $this->buildParameters(0, [], [], [], $this->token()));
    }

    /**
     * Unsubscribe from a record
     *
     * @param $id
     * @return bool
     */
    public function unsubscribe($id)
    {
        return $this->deleteRequest($this->module . "/" . $id . "/" . __FUNCTION__, $this->buildParameters(0, [], [], [], $this->token()));
    }
}