<?php namespace Troward\SugarAPI\Contracts;

/**
 * Interface BaseModuleContract
 * @package Troward\SugarAPI\Contracts
 */
interface BaseModuleContract {
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
     * Returns all records based on existing filters
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
     * Finds the first record
     *
     * @param $key
     * @param $value
     * @param array $fields
     * @return array
     */
    public function find($key, $value, $fields = []);

    /**
     * Appends a filter to the query
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function where($key, $value);
}