<?php namespace Troward\SugarAPI;

/**
 * Class Module
 * @package Troward\SugarAPI
 */
class Module implements ModuleInterface
{
    /**
     * Name of the module
     *
     * @var string
     */
    public $name;

    /**
     * Filters for record query
     *
     * @var array
     */
    public $filters = [
        '$and' => [],
        '$or' => [],
    ];

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ParameterInterface
     */
    private $parameters;

    /**
     * @param $name
     * @param RequestInterface $request
     * @param ParameterInterface $parameters
     */
    function __construct($name, RequestInterface $request, ParameterInterface $parameters)
    {
        $this->name = $name;
        $this->request = $request;
        $this->parameters = $parameters;
    }

    /**
     * Finds the first record by value
     *
     * @param $key
     * @param $value
     * @param array $fields
     * @return Result
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
     * @return Result
     */
    public function all($limit = 500, $fields = [], $orderBy = [])
    {
        return $this->request->get($this->name, $this->parameters->filter($limit, [], $fields, $orderBy));
    }

    /**
     * Returns all records, with any possible existing filters
     *
     * @param int $limit
     * @param array $fields
     * @param array $orderBy
     * @return Result
     */
    public function get($limit = 500, $fields = [], $orderBy = [])
    {
        return $this->request->get($this->name . "/filter", $this->parameters->filter($limit, $this->filters, $fields, $orderBy));
    }

    /**
     * Creates a new record
     *
     * @param array $fields
     * @return Result
     */
    public function create(array $fields)
    {
        return $this->request->post($this->name, $this->parameters->filter(0, [], $fields, []));
    }

    /**
     * Updates an existing record based on 'id'
     *
     * @param $id
     * @param array $fields
     * @return Result
     */
    public function update($id, array $fields)
    {
        return $this->request->put($this->name . "/" . $id, $this->parameters->filter(0, [], $fields, []));
    }

    /**
     * Deletes an existing record based on 'id'
     *
     * @param $id
     * @return Result
     */
    public function delete($id)
    {
        return $this->request->delete($this->name . "/" . $id, $this->parameters->filter(0, [], [], []));
    }

    /**
     * Get related records by module
     *
     * @param $id
     * @param $relatedModule
     * @param array $fields
     * @return Result
     */
    public function getRelation($id, $relatedModule, $fields = [])
    {
        return $this->request->get($this->name . "/" . $id . "/link/" . strtolower($relatedModule), $this->parameters->filter(0, [], $fields, []));
    }

    /**
     * Set related record by module and id
     *
     * @param $id
     * @param $relatedModule
     * @param $relatedId
     * @return Result
     */
    public function setRelation($id, $relatedModule, $relatedId)
    {
        return $this->request->post($this->name . "/" . $id . "/link/" . strtolower($relatedModule) . "/" . $relatedId, $this->parameters->tokenOnly());
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
     * Favorites a record
     *
     * @param $id
     * @return Result
     */
    public function favorite($id)
    {
        return $this->request->put($this->name . "/" . $id . "/" . __FUNCTION__, $this->parameters->tokenOnly());
    }

    /**
     * Unfavorite a record
     *
     * @param $id
     * @return Result
     */
    public function unfavorite($id)
    {
        return $this->request->put($this->name . "/" . $id . "/" . __FUNCTION__, $this->parameters->tokenOnly());
    }

    /**
     * Subscribe to a record
     *
     * @param $id
     * @return Result
     */
    public function subscribe($id)
    {
        return $this->request->post($this->name . "/" . $id . "/" . __FUNCTION__, $this->parameters->tokenOnly());
    }

    /**
     * Unsubscribe to a record
     *
     * @param $id
     * @return Result
     */
    public function unsubscribe($id)
    {
        return $this->request->delete($this->name . "/" . $id . "/" . __FUNCTION__, $this->parameters->tokenOnly());
    }

    /**
     * @param $id
     * @return Result
     */
    public function getFileList($id)
    {
        return $this->request->get($this->name . "/" . $id . "/file", $this->parameters->tokenOnly());
    }

    /**
     * Download a file
     *
     * @param $id
     * @param $destinationPath
     * @param string $field
     * @return Result
     */
    public function downloadFile($id, $destinationPath, $field = 'filename')
    {
        $response = $this->request->get($this->name . "/" . $id . "/file/" . $field, $this->parameters->tokenOnly());

        file_put_contents($destinationPath, $response->getBody()->getContents());

        return $response;
    }

    /**
     * Upload a file
     *
     * @param $id
     * @param $sourcePath
     * @param string $field
     * @return Result
     */
    public function uploadFile($id, $sourcePath, $field = 'filename')
    {
        return $this->request->post($this->name . "/" . $id . "/file/" . $field, $this->parameters->fileUpload($sourcePath));
    }

    /**
     * @param $id
     * @param string $field
     * @return Result
     */
    public function deleteFile($id, $field = 'filename')
    {
        return $this->request->delete($this->name . "/" . $id . "/file/" . $field, $this->parameters->tokenOnly());
    }

    /**
     * @param $id
     * @return Result
     */
    public function changeLog($id)
    {
        return $this->request->get($this->name . "/" . $id . "/audit", $this->parameters->tokenOnly());
    }
}