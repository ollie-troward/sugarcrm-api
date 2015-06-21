<?php namespace Troward\SugarAPI;

use Troward\SugarAPI\Contracts\ConfigContract;
use Troward\SugarAPI\Contracts\ParameterContract;
use Troward\SugarAPI\Contracts\TokenContract;

class Parameter implements ParameterContract
{
    /**
     * No parameters with token
     *
     * @param TokenContract $token
     * @return array
     */
    public function none(TokenContract $token)
    {
        return ['headers' => ['oauth-token' => $token->getAccessToken()]];
    }

    /**
     * Builds the HTTP Token Request Parameters
     *
     * @param ConfigContract $config
     * @return array
     */
    public function token(ConfigContract $config)
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
     * @param TokenContract $token
     * @return array
     */
    public function filter($limit, array $filters, array $fields, array $orderBy, TokenContract $token)
    {
        return [
            'headers' => ['oauth-token' => $token->getAccessToken()],
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
     * @param TokenContract $token
     * @return array
     */
    public function fileUpload($sourcePath, TokenContract $token)
    {
        return [
            'headers' => ['oauth-token' => $token->getAccessToken()],
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