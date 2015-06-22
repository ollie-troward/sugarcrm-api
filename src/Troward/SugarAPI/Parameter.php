<?php namespace Troward\SugarAPI;

/**
 * Class Parameter
 * @package Troward\SugarAPI
 */
class Parameter implements ParameterInterface
{
    /**
     * @var Token
     */
    private $token;

    /**
     * @param Token $token
     */
    function __construct(Token $token = null)
    {
        $this->token = $token;
    }

    /**
     * @param Token $token
     */
    public function setToken(Token $token)
    {
        $this->token = $token;
    }

    /**
     * No parameters with token
     *
     * @return array
     */
    public function tokenOnly()
    {
        return ['headers' => ['oauth-token' => $this->token->getAccessToken()]];
    }

    /**
     * Builds the HTTP Token Request Parameters
     *
     * @param Config $config
     * @return array
     */
    public function newToken(Config $config)
    {
        return [
            'json' =>
                [
                    "grant_type" => "password",
                    "client_id" => $config->getConsumerKey(),
                    "client_secret" => $config->getConsumerSecret(),
                    "username" => $config->getUsername(),
                    "password" => $config->getPassword(),
                    "platform" => "base"
                ]
        ];
    }

    /**
     * Builds the HTTP Request Parameters
     *
     * @param $limit
     * @param array $filters
     * @param array $fields
     * @param array $orderBy
     * @return array
     */
    public function filter($limit, array $filters, array $fields, array $orderBy)
    {
        return [
            'headers' => ['oauth-token' => $this->token->getAccessToken()],
            'json' =>
                [
                    'filter' => [$filters],
                    'max_num' => $limit,
                    'offset' => 0,
                    'fields' => $this->buildFields($fields),
                    'order_by' => $this->buildOrderBy($orderBy)
                ]
        ];
    }

    /**
     * Builds the necessary file parameters for an upload
     *
     * @param $sourcePath
     * @return array
     */
    public function fileUpload($sourcePath)
    {
        return [
            'headers' => ['oauth-token' => $this->token->getAccessToken()],
            'body' =>
                [
                    'filename' => fopen($sourcePath, 'r'),
                    'format' => 'sugar-html-json',
                    'delete_if_fails' => true
                ]
        ];
    }

    /**
     * Build the parameter Fields
     *
     * @param array $fields
     * @return string
     */
    protected function buildFields(array $fields)
    {
        return implode(" ", $fields);
    }

    /**
     * Build the Order By parameter
     *
     * @param array $orderBy
     * @return string
     */
    protected function buildOrderBy(array $orderBy)
    {
        if (empty($orderBy)) return "";

        $orderColumn = array_keys($orderBy)[0];

        $orderType = $orderBy[$orderColumn];

        return $orderColumn . ":" . $orderType;
    }
}