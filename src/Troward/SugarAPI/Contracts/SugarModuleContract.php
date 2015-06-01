<?php namespace Troward\SugarAPI\Contracts;

/**
 * Interface SugarModuleContract
 * @package Troward\SugarAPI\Contracts
 */
interface SugarModuleContract {

    /**
     * Finds the first record by value
     *
     * @param $key
     * @param $value
     * @param array $fields
     * @return array
     */
    public function find($key, $value, $fields = []);

    /**
     * Returns all records
     *
     * @param int $limit
     * @param array $fields
     * @param array $orderBy
     * @return array
     */
    public function all($limit = 500, $fields = [], $orderBy = []);

    /**
     * Returns all records, with any possible existing filters
     *
     * @param int $limit
     * @param array $fields
     * @param array $orderBy
     * @return array
     */
    public function get($limit = 500, $fields = [], $orderBy = []);

    /**
     * Creates a new record
     *
     * @param array $fields
     * @return array
     */
    public function create(array $fields);

    /**
     * Updates an existing record based on 'id'
     *
     * @param $id
     * @param array $fields
     * @return array
     */
    public function update($id, array $fields);

    /**
     * Deletes an existing record based on 'id'
     *
     * @param $id
     * @return array
     */
    public function delete($id);

    /**
     * Appends an AND filter to the query
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function where($key, $value);

    /**
     * Appends an OR filter to the query
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function orWhere($key, $value);

    /**
     * Favorites a record
     *
     * @param $id
     * @return bool
     */
    public function favorite($id);

    /**
     * Unfavorite a record
     *
     * @param $id
     * @return bool
     */
    public function unfavorite($id);

    /**
     * Subscribe to a record
     *
     * @param $id
     * @return bool
     */
    public function subscribe($id);

    /**
     * Unsubscribe to a record
     *
     * @param $id
     * @return bool
     */
    public function unsubscribe($id);

    /**
     * Exports a record list
     *
     * @param $recordListId
     * @param int $limit
     * @param array $fields
     * @param array $orderBy
     * @return array
     */
    public function export($recordListId, $limit = 500, $fields = [], $orderBy = []);

    /**
     * Imports a record list
     *
     * @param array $recordIds
     * @return mixed
     */
    public function import(array $recordIds);

    public function getAttachment();

    public function setAttachment();
}