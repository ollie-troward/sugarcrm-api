<?php namespace Troward\SugarAPI\Contracts;

/**
 * Interface ParameterContract
 * @package Troward\SugarAPI\Contracts
 */
interface ParameterContract
{
    /**
     * No parameters with token
     *
     * @param TokenContract $token
     * @return array
     */
    public function none(TokenContract $token);

    /**
     * Builds the HTTP Token Request Parameters
     *
     * @param ConfigContract $config
     * @return array
     */
    public function token(ConfigContract $config);

    /**
     * Builds the HTTP Request Parameters
     *
     * @param $limit
     * @param array $filters
     * @param array $fields
     * @param array $orderBy
     * @param TokenContract $token
     * @return array
     */
    public function filter($limit, array $filters, array $fields, array $orderBy, TokenContract $token);

    /**
     * Builds the necessary file parameters for an upload
     *
     * @param $sourcePath
     * @param TokenContract $token
     * @return array
     */
    public function fileUpload($sourcePath, TokenContract $token);
}