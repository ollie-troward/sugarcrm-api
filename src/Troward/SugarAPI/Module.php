<?php namespace Troward\SugarAPI;

use Troward\SugarAPI\Contracts\ModuleContract;
use Troward\SugarAPI\Exceptions\ClientException;

/**
 * Class Module
 * @package Troward\SugarAPI
 */
class Module extends Client implements ModuleContract {

    /**
     * @var string
     */
    protected $module;

    /**
     * @var array
     */
    protected $filters;

    /**
     *
     */
    function __construct()
    {
        $this->isModuleValid();
        parent::__construct();
    }

    /**
     *
     */
    private function isModuleValid()
    {
        if (empty($this->module)) throw new ClientException("Module not set for request");

        return true;
    }

    /**
     * @return static
     */
    private function token()
    {
        return Token::retrieve();
    }

    /**
     * @param array $limit
     * @param array $filters
     * @param array $fields
     * @param array $orderBy
     * @return array
     */
    private function buildParameters($limit, array $filters, array $fields, array $orderBy)
    {
        return [
            'filter' => $this->buildFilters($filters),
            'max_num' => $limit,
            'offset' => 0,
            'fields' => $this->buildFields($fields),
            'order_by' => $this->buildOrderBy($orderBy),
        ];
    }

    /**
     * @param array $filters
     * @return array
     */
    private function buildFilters(array $filters)
    {
        if (empty($this->filters)) return [$filters];

        return [$this->filters];
    }

    /**
     * @param array $fields
     * @return string
     */
    private function buildFields(array $fields)
    {
        return implode(" ", $fields);
    }

    /**
     * @param array $orderBy
     * @return array|string
     */
    private function buildOrderBy(array $orderBy)
    {
        if (empty($orderBy)) return $orderBy;

        $orderColumn = array_keys($orderBy)[0];

        $orderType = $orderBy[$orderColumn];

        return $orderColumn . ':' . $orderType;
    }

    /**
     * @param array $result
     * @return $this
     */
    protected function setModuleProperties(array $result)
    {
        foreach ($result as $property => $value)
        {
            $this->$property = $value;
        }

        return $this;
    }

    /**
     * @return true
     */
    protected function moduleExists()
    {
        if (!isset($this->id)) throw new ClientException("No record specified for " . $this->module);

        return true;
    }

    /**
     * @param $module
     * @param $limit
     * @param $fields
     * @param $orderBy
     * @return mixed
     */
    public function getAll($module, $limit, array $fields, array $orderBy)
    {
        return $this->getRequest($module, $this->buildParameters($limit, [], $fields, $orderBy), $this->token())['records'];
    }

    /**
     * @param $module
     * @param $limit
     * @param array $filters
     * @param array $fields
     * @param array $orderBy
     * @return mixed
     * @internal param array $filter
     */
    public function getByFilter($module, $limit, array $filters, array $fields, array $orderBy)
    {
        return $this->getRequest($module, $this->buildParameters($limit, $filters, $fields, $orderBy), $this->token())['records'];
    }

    /**
     * @param $module
     * @param array $filter
     * @param array $fields
     * @return mixed
     */
    public function getFirst($module, array $filter, array $fields)
    {
        return $this->getByFilter($module, 1, $filter, $fields, []);
    }

    /**
     * @param $module
     * @param array $fields
     * @param string $uri
     * @return array
     */
    public function post($module, array $fields, $uri = "")
    {
        return $this->postRequest($module . "/" . $uri, $fields, $this->token());
    }

    /**
     * @param $module
     * @param $id
     * @param array $fields
     * @param string $uri
     * @return array
     */
    public function postWithId($module, $id, array $fields, $uri = "")
    {
        return $this->postRequest($module . "/" . $id . "/" . $uri, $fields, $this->token());
    }

    /**
     * @param $module
     * @param $id
     * @param array $fields
     * @param $uri
     * @return array
     */
    public function put($module, $id, array $fields, $uri = "")
    {
        return $this->putRequest($module . "/" . $id . "/" . $uri, $fields, $this->token());
    }

    /**
     * @param $module
     * @param $id
     * @param string $uri
     * @return array
     */
    public function deleteById($module, $id, $uri = "")
    {
        return $this->deleteRequest($module . "/" . $id . "/" . $uri, $this->token());
    }
}