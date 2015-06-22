<?php namespace Troward\SugarAPI;

/**
 * Interface ParameterContract
 * @package Troward\SugarAPI
 */
interface ParameterInterface
{
    /**
     * @param Token $token
     */
    public function setToken(Token $token);

    /**
     * No parameters with token
     *
     * @return array
     */
    public function tokenOnly();

    /**
     * Builds the HTTP Token Request Parameters
     *
     * @param Config $config
     * @return array
     */
    public function newToken(Config $config);

    /**
     * Builds the HTTP Request Parameters
     *
     * @param $limit
     * @param array $filters
     * @param array $fields
     * @param array $orderBy
     * @return array
     */
    public function filter($limit, array $filters, array $fields, array $orderBy);

    /**
     * Builds the necessary file parameters for an upload
     *
     * @param $sourcePath
     * @return array
     */
    public function fileUpload($sourcePath);
}