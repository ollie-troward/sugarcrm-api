<?php namespace Troward\SugarAPI;

use Troward\SugarAPI\Contracts\TokenContract;

/**
 * Class Token
 * @package Troward\SugarAPI
 */
class Token extends Client implements TokenContract {

    /**
     * @var Config
     */
    private $config;
    /**
     * @var void
     */
    private $token;

    /**
     * @param Config $config
     */
    function __construct(Config $config)
    {
        $this->config = $config;
        $this->token = $this->retrieve();
    }

    /**
     * @return mixed
     */
    public function retrieve()
    {
        $newToken = $this->initialise($this->config)->post('oauth2/token',
            [
                "grant_type" => 'password',
                "client_id" => $this->config->getConsumerKey(),
                "client_secret" => $this->config->getConsumerSecret(),
                "username" => $this->config->getUsername(),
                "password" => $this->config->getPassword(),
                "platform" => "base",
            ]
        );

        return $this->token = $newToken['access_token'];
    }

}