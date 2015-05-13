<?php namespace Troward\SugarAPI\Contracts;

/**
 * Interface ClientContract
 * @package Troward\SugarAPI\Contracts
 */
interface ClientContract {
    /**
     * @return mixed
     */
    public function get();

    /**
     * @return mixed
     */
    public function post();

    /**
     * @return mixed
     */
    public function put();

    /**
     * @return mixed
     */
    public function delete();
}