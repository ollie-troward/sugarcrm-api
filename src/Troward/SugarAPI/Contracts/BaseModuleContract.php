<?php namespace Troward\SugarAPI\Contracts;

/**
 * Interface BaseModuleContract
 * @package Troward\SugarAPI\Contracts
 */
interface BaseModuleContract {
    /**
     * @param int $limit
     * @param array $fields
     * @param array $orderBy
     * @return mixed
     */
    public function all($limit = 500, $fields = [], $orderBy = []);

    /**
     * @param int $limit
     * @param array $fields
     * @param $orderBy
     * @return mixed
     */
    public function get($limit = 500, $fields = [], $orderBy = []);

    /**
     * @param array $fields
     * @return mixed
     */
    public function create(array $fields);

    /**
     * @param $id
     * @param array $fields
     * @return mixed
     */
    public function update($id, array $fields);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @param $key
     * @param $value
     * @param array $fields
     * @return mixed
     */
    public function find($key, $value, $fields = []);

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function where($key, $value);
}