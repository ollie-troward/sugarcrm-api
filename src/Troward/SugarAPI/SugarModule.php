<?php namespace Troward\SugarAPI;

use Troward\SugarAPI\Contracts\SugarModuleContract;

/**
 * Class SugarModule
 * @package Troward\SugarAPI
 */
class SugarModule extends SugarBase implements SugarModuleContract
{
    /**
     * Name of the Module
     *
     * @var string
     */
    protected $module;

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
        parent::__construct();
        $this->module = $module;
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
        return $this->client->get($this->module, $this->parameters->filter($limit, [], $fields, $orderBy, $this->token()));
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
        return $this->client->get($this->module . "/filter", $this->parameters->filter($limit, $this->filters, $fields, $orderBy, $this->token()));
    }

    /**
     * Creates a new record
     *
     * @param array $fields
     * @return array
     */
    public function create(array $fields)
    {
        return $this->client->post($this->module, $this->parameters->filter(0, [], $fields, [], $this->token()));
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
        return $this->client->put($this->module . "/" . $id, $this->parameters->filter(0, [], $fields, [], $this->token()));
    }

    /**
     * Deletes an existing record based on 'id'
     *
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        return $this->client->delete($this->module . "/" . $id, $this->parameters->filter(0, [], [], [], $this->token()));
    }

    /**
     * Get related records by module
     *
     * @param $id
     * @param $relatedModule
     * @param array $fields
     * @return $this
     */
    public function getRelation($id, $relatedModule, $fields = [])
    {
        return $this->client->get($this->module . "/" . $id . "/link/" . strtolower($relatedModule), $this->parameters->filter(0, [], $fields, [], $this->token()));
    }

    /**
     * Set related record by module and id
     *
     * @param $id
     * @param $relatedModule
     * @param $relatedId
     * @return mixed
     */
    public function setRelation($id, $relatedModule, $relatedId)
    {
        return $this->client->post($this->module . "/" . $id . "/link/" . strtolower($relatedModule) . "/" . $relatedId, $this->parameters->none($this->token()));
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
        return $this->client->put($this->module . "/" . $id . "/" . __FUNCTION__, $this->parameters->none($this->token()));
    }

    /**
     * Unfavorite a record
     *
     * @param $id
     * @return bool
     */
    public function unfavorite($id)
    {
        return $this->client->put($this->module . "/" . $id . "/" . __FUNCTION__, $this->parameters->none($this->token()));
    }

    /**
     * Subscribe to a record
     *
     * @param $id
     * @return bool
     */
    public function subscribe($id)
    {
        return $this->client->post($this->module . "/" . $id . "/" . __FUNCTION__, $this->parameters->none($this->token()));
    }

    /**
     * Unsubscribe from a record
     *
     * @param $id
     * @return bool
     */
    public function unsubscribe($id)
    {
        return $this->client->delete($this->module . "/" . $id . "/" . __FUNCTION__, $this->parameters->none($this->token()));
    }

    /**
     * @param $id
     * @return array|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     */
    public function getFileList($id)
    {
        return $this->client->get($this->module . "/" . $id . "/file", $this->parameters->none($this->token()));
    }

    /**
     * @param $id
     * @param $destinationPath
     * @param string $field
     * @return array|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     */
    public function downloadFile($id, $destinationPath, $field = 'filename')
    {
        $response = $this->client->get($this->module . "/" . $id . "/file/" . $field, $this->parameters->none($this->token()));

        file_put_contents($destinationPath, $response->getBody()->getContents());

        return $response;
    }

    /**
     * @param $id
     * @param $sourcePath
     * @param string $field
     * @return array|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     */
    public function uploadFile($id, $sourcePath, $field = 'filename')
    {
        return $this->client->post($this->module . "/" . $id . "/file/" . $field, $this->parameters->fileUpload($sourcePath, $this->token()));
    }

    /**
     * @param $id
     * @param string $field
     * @return array|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     */
    public function deleteFile($id, $field = "filename")
    {
        return $this->client->delete($this->module . "/" . $id . "/file/" . $field, $this->parameters->none($this->token()));
    }

    /**
     * @param $id
     * @return array|\GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|mixed|null
     */
    public function changeLog($id)
    {
        return $this->client->get($this->module . "/" . $id . "/audit", $this->parameters->none($this->token()));
    }
}