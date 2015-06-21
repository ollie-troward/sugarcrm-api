<?php namespace Troward\SugarAPI;

use Troward\SugarAPI\Contracts\SugarClientContract;

/**
 * Class SugarClient
 * @package Troward\SugarAPI
 */
class SugarClient extends SugarBase implements SugarClientContract
{
    /**
     * @param int $days
     * @return array|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     */
    public function mostActiveUsers($days = 30)
    {
        return $this->client->get("mostactiveusers?days=" . $days, $this->parameters->none($this->token()));
    }

    /**
     * @return array|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     */
    public function ping()
    {
        return $this->client->get("ping", $this->parameters->none($this->token()));
    }

    /**
     * @return array|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     */
    public function whatTimeIsIt()
    {
        return $this->client->get("ping/whattimeisit", $this->parameters->none($this->token()));
    }

    public function recentRecords(array $modules)
    {
        return $this->client->get("recent", $this->parameters->none($this->token()));
    }

    public function search()
    {
        // TODO: Implement search() method.
    }
}