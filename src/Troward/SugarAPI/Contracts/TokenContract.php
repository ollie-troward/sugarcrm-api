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

    /**
     * @return string
     */
    public function getAccessToken();

    /**
     * @return string
     */
    public function getExpiresIn();
}