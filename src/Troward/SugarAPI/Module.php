<?php namespace Troward\SugarAPI;

use Troward\SugarAPI\Contracts\ModuleContract;

class Module extends Client implements ModuleContract {

    /**
     * @param $name
     */
    function __construct($name = null)
    {
        parent::__construct();
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
     * @param array $fields
     * @param array $orderBy
     * @return array
     */
    private function buildParameters($limit, array $fields, array $orderBy)
    {
        return [
            'max_num' => $limit,
            'offset' => 0,
            'fields' => $this->buildFields($fields),
            'order_by' => $this->buildOrderBy($orderBy),
        ];
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
     * @param $module
     * @param $limit
     * @param $fields
     * @param $orderBy
     * @return mixed
     */
    public function retrieve($module, $limit, array $fields, array $orderBy)
    {
        return $this->get($module, $this->buildParameters($limit, $fields, $orderBy), $this->token())['records'];
    }

}