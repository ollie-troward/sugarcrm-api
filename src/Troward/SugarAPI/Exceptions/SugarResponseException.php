<?php namespace Troward\SugarAPI\Exceptions;

use GuzzleHttp\Exception\BadResponseException;

/**
 * Class SugarResponseException
 * @package Troward\SugarAPI\Exceptions
 */
class SugarResponseException extends \RuntimeException
{
    /**
     * @param BadResponseException $e
     */
    function __construct(BadResponseException $e)
    {
        parent::__construct($this->getError($e));
    }

    /**
     * Seeks out the error if it is a client issue or SugarCRM issue
     *
     * @param BadResponseException $e
     * @return string
     */
    public function getError(BadResponseException $e)
    {
        try
        {
            $response = $e->getResponse()->json();
        } catch (\RuntimeException $e)
        {
            return $e->getMessage();
        }

        return $this->sugarResponse($response);
    }

    /**
     * Builds the SugarCRM error response
     *
     * @param array $response
     * @return string
     */
    protected function sugarResponse(array $response)
    {
        return "SugarCRM responded with error: " . $response['error'] . " and the message: " . $response['error_message'];
    }
}