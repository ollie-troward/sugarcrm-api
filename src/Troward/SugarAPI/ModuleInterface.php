<?php namespace Troward\SugarAPI;

interface ModuleInterface
{
    /**
     * Finds the first record by value
     *
     * @param $key
     * @param $value
     * @param array $fields
     * @return Result
     */
    public function find($key, $value, $fields = []);

    /**
     * Returns all records
     *
     * @param int $limit
     * @param array $fields
     * @param array $orderBy
     * @return Result
     */
    public function all($limit = 500, $fields = [], $orderBy = []);

    /**
     * Returns all records, with any possible existing filters
     *
     * @param int $limit
     * @param array $fields
     * @param array $orderBy
     * @return Result
     */
    public function get($limit = 500, $fields = [], $orderBy = []);

    /**
     * Creates a new record
     *
     * @param array $fields
     * @return Result
     */
    public function create(array $fields);

    /**
     * Updates an existing record based on 'id'
     *
     * @param $id
     * @param array $fields
     * @return Result
     */
    public function update($id, array $fields);

    /**
     * Deletes an existing record based on 'id'
     *
     * @param $id
     * @return Result
     */
    public function delete($id);

    /**
     * Get related records by module
     *
     * @param $id
     * @param $relatedModule
     * @param array $fields
     * @return Result
     */
    public function getRelation($id, $relatedModule, $fields = []);

    /**
     * Set related record by module and id
     *
     * @param $id
     * @param $relatedModule
     * @param $relatedId
     * @return Result
     */
    public function setRelation($id, $relatedModule, $relatedId);

    /**
     * Appends an AND filter to the query
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function where($key, $value);

    /**
     * Appends an OR filter to the query
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function orWhere($key, $value);

    /**
     * Favorites a record
     *
     * @param $id
     * @return Result
     */
    public function favorite($id);

    /**
     * Unfavorite a record
     *
     * @param $id
     * @return Result
     */
    public function unfavorite($id);

    /**
     * Subscribe to a record
     *
     * @param $id
     * @return Result
     */
    public function subscribe($id);

    /**
     * Unsubscribe to a record
     *
     * @param $id
     * @return Result
     */
    public function unsubscribe($id);

    /**
     * @param $id
     * @return Result
     */
    public function getFileList($id);

    /**
     * Download a file
     *
     * @param $id
     * @param $destinationPath
     * @param string $field
     * @return Result
     */
    public function downloadFile($id, $destinationPath, $field = 'filename');

    /**
     * Upload a file
     *
     * @param $id
     * @param $sourcePath
     * @param string $field
     * @return Result
     */
    public function uploadFile($id, $sourcePath, $field = 'filename');

    /**
     * @param $id
     * @param string $field
     * @return Result
     */
    public function deleteFile($id, $field = 'filename');

    /**
     * @param $id
     * @return Result
     */
    public function changeLog($id);
}