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
}