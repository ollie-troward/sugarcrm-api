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
    public function retrieve($module, $limit, array $fields, array $orderBy);

    /**
     * @param $module
     * @param array $filter
     * @param array $fields
     * @return mixed
     */
    public function retrieveFirst($module, array $filter, array $fields);

    /**
     * @param $module
     * @param $limit
     * @param array $filter
     * @param array $fields
     * @param array $orderBy
     * @return mixed
     */
    public function retrieveByFilter($module, $limit, array $filter, array $fields, array $orderBy);
}