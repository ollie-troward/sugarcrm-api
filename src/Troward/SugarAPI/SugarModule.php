<?php namespace Troward\SugarAPI;

use Troward\SugarAPI\Contracts\SugarModuleContract;

/**
 * Class SugarModule
 * @package Troward\SugarAPI
 */
class SugarModule implements SugarModuleContract
{
    /**
     * Name of the Module
     *
     * @var string
     */
    protected $module;

    /**
     * The Client used for the API
     *
     * @var GuzzleClient
     */
    protected $client;

    /**
     * Filters for record query
     *
     * @var array
     */
    protected $filters = [
        '$and' => [],
        '$or' => [],
    ];

    /**
     * @param string $module
     */
    function __construct($module)
    {
        $this->module = $module;
        $this->client = new GuzzleClient;
    }

    /**
     * Retrieves the latest token
     *
     * @return Token
     */
    protected function token()
    {
        return Token::retrieve();
    }

    /**
     * Finds the first record
     *
     * @param $key
     * @param $value
     * @param array $fields
     * @return $this
     */
    public function find($key, $value, $fields = [])
    {
        $this->where($key, $value);

        return $this->get(1, $fields, []);
    }

    /**
     * Returns all records
     *
     * @param int $limit
     * @param array $fields
     * @param array $orderBy
     * @return array
     */
    public function all($limit = 500, $fields = [], $orderBy = [])
    {
        return $this->client->get($this->module, $this->client->buildParameters($limit, [], $fields, $orderBy, $this->token()));
    }

    /**
     * Returns all records based on existing filters
     *
     * @param int $limit
     * @param array $fields
     * @param array $orderBy
     * @return array
     */
    public function get($limit = 500, $fields = [], $orderBy = [])
    {
        return $this->client->get($this->module . "/filter", $this->client->buildParameters($limit, $this->filters, $fields, $orderBy, $this->token()));
    }

    /**
     * Creates a new record
     *
     * @param array $fields
     * @return array
     */
    public function create(array $fields)
    {
        return $this->client->post($this->module, $this->client->buildParameters(0, [], $fields, [], $this->token()));
    }

    /**
     * Updates an existing record based on 'id'
     *
     * @param $id
     * @param array $fields
     * @return array
     */
    public function update($id, array $fields)
    {
        return $this->client->put($this->module . "/" . $id, $this->client->buildParameters(0, [], $fields, [], $this->token()));
    }

    /**
     * Deletes an existing record based on 'id'
     *
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        return $this->client->delete($this->module . "/" . $id, $this->client->buildParameters(0, [], [], [], $this->token()));
    }

    /**
     * Links related records by module
     *
     * @param $id
     * @param $relatedModule
     * @param array $fields
     * @return $this
     */
    public function link($id, $relatedModule, $fields = [])
    {
        return $this->client->get($this->module . "/" . $id . "/link/" . strtolower($relatedModule), $this->client->buildParameters(0, [], $fields, [], $this->token()));
    }

    /**
     * Appends an AND filter to the query
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function where($key, $value)
    {
        $this->filters['$and'][] = [$key => $value];

        return $this;
    }

    /**
     * Appends an OR filter to the query
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function orWhere($key, $value)
    {
        $this->filters['$or'][] = [$key => $value];

        return $this;
    }

    /**
     * Favorite a record
     *
     * @param $id
     * @return bool
     */
    public function favorite($id)
    {
        return $this->client->put($this->module . "/" . $id . "/" . __FUNCTION__, $this->client->buildParameters(0, [], [], [], $this->token()));
    }

    /**
     * Unfavorite a record
     *
     * @param $id
     * @return bool
     */
    public function unfavorite($id)
    {
        return $this->client->put($this->module . "/" . $id . "/" . __FUNCTION__, $this->client->buildParameters(0, [], [], [], $this->token()));
    }

    /**
     * Subscribe to a record
     *
     * @param $id
     * @return bool
     */
    public function subscribe($id)
    {
        return $this->client->post($this->module . "/" . $id . "/" . __FUNCTION__, $this->client->buildParameters(0, [], [], [], $this->token()));
    }

    /**
     * Unsubscribe from a record
     *
     * @param $id
     * @return bool
     */
    public function unsubscribe($id)
    {
        return $this->client->delete($this->module . "/" . $id . "/" . __FUNCTION__, $this->client->buildParameters(0, [], [], [], $this->token()));
    }

    /**
     * @param $recordId
     * @param $destinationPath
     * @return array|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     */
    public function downloadFile($recordId, $destinationPath)
    {
        $response = $this->client->get($this->module . "/" . $recordId . "/file/filename", $this->client->buildParameters(0, [], [], [], $this->token()));

        file_put_contents($destinationPath, $response->getBody()->getContents());

        return $response;
    }

    /**
     * @param $recordId
     * @param $sourcePath
     * @return array|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     */
    public function uploadFile($recordId, $sourcePath)
    {
        return $this->client->post($this->module . "/" . $recordId . "/file/filename", $this->client->buildFileParameters($sourcePath, $this->token()));
    }
}