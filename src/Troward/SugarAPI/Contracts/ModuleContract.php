<?php namespace Troward\SugarAPI\Contracts;

/**
 * Interface ModuleContract
 * @package Troward\SugarAPI\Contracts
 */
interface ModuleContract {
    /**
     * @param $module
     * @param $limit
     * @return mixed
     */
    public function retrieve($module, $limit);
}