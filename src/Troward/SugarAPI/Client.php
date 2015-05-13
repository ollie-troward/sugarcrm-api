<?php namespace Troward\SugarAPI;

use Troward\SugarAPI\Contracts\ClientContract;

class Client implements ClientContract {
    /**
     * @var Config
     */
    private $config;

    function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        // TODO: Implement get() method.
    }

    /**
     * @return mixed
     */
    public function post()
    {
        // TODO: Implement post() method.
    }

    /**
     * @return mixed
     */
    public function put()
    {
        // TODO: Implement put() method.
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        // TODO: Implement delete() method.
    }


}