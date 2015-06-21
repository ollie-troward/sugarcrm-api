<?php namespace Troward\SugarAPI\Contracts;

/**
 * Interface SugarClientContract
 * @package Troward\SugarAPI\Contracts
 */
interface SugarClientContract
{
    /**
     * @param $days
     * @return mixed
     */
    public function mostActiveUsers($days = 30);

    public function ping();

    public function whatTimeIsIt();

    public function recentRecords(array $modules);

    public function search();
}