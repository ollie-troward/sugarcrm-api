<?php namespace Troward\SugarAPI\Contracts;

/**
 * Interface TokenContract
 * @package Troward\SugarAPI\Contracts
 */
interface TokenContract {

    /**
     * @return mixed
     */
    public static function retrieve();

    /**
     * @return static
     */
    public function make();

    /**
     * @return true
     */
    public function destroy();
}