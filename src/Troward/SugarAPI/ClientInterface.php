<?php namespace Troward\SugarAPI;

/**
 * Interface ClientInterface
 * @package Troward\SugarAPI
 */
interface ClientInterface
{
    /**
     * @param $name
     * @return Module
     */
    public function module($name);

    /**
     * @return Other
     */
    public function other();

    /**
     * @return Token
     */
    public function token();

    /**
     * @return Config
     */
    public function config();
}