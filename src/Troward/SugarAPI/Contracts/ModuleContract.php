<?php namespace Troward\SugarAPI\Contracts;

/**
 * Interface ModuleContract
 * @package Troward\SugarAPI\Contracts
 */
interface ModuleContract {

    /**
     * @param $module
     * @param $limit
     * @param $fields
     * @param $orderBy
     * @return mixed
     */
    public function getAll($module, $limit, array $fields, array $orderBy);

    /**
     * @param $module
     * @param array $filter
     * @param array $fields
     * @return mixed
     */
    public function getFirst($module, array $filter, array $fields);

    /**
     * @param $module
     * @param $limit
     * @param array $filter
     * @param array $fields
     * @param array $orderBy
     * @return mixed
     */
    public function getByFilter($module, $limit, array $filter, array $fields, array $orderBy);

    /**
     * @param $module
     * @param array $fields
     * @param string $uri
     * @return mixed
     */
    public function post($module, array $fields, $uri = "");

    /**
     * @param $module
     * @param $id
     * @param array $fields
     * @param string $uri
     * @return mixed
     */
    public function postWithId($module, $id, array $fields, $uri = "");

    /**
     * @param $module
     * @param $id
     * @param array $fields
     * @param string $uri
     * @return mixed
     */
    public function put($module, $id, array $fields, $uri = "");

    /**
     * @param $module
     * @param $id
     * @param string $uri
     * @return mixed
     */
    public function deleteById($module, $id, $uri = "");
}