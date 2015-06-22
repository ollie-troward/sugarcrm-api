<?php namespace Troward\SugarAPI;

/**
 * Interface OtherInterface
 * @package Troward\SugarAPI
 */
interface OtherInterface
{
    /**
     * @param $days
     * @return Result
     */
    public function mostActiveUsers($days = 30);

    /**
     * @return Result
     */
    public function ping();

    /**
     * @return Result
     */
    public function whatTimeIsIt();

    /**
     * @param array $modules
     * @return Result
     */
    public function recentRecords(array $modules);

    /**
     * @return Result
     */
    public function search();
}