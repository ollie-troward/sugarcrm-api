<?php namespace Troward\SugarAPI;

class Other implements OtherInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ParameterInterface
     */
    private $parameters;

    /**
     * @param RequestInterface $request
     * @param ParameterInterface $parameters
     */
    function __construct(RequestInterface $request, ParameterInterface $parameters)
    {
        $this->request = $request;
        $this->parameters = $parameters;
    }

    /**
     * @param $days
     * @return Result
     */
    public function mostActiveUsers($days = 30)
    {
        return $this->request->get("mostactiveusers?days=" . $days, $this->parameters->tokenOnly());
    }

    /**
     * @return Result
     */
    public function ping()
    {
        return $this->request->get("ping", $this->parameters->tokenOnly());
    }

    /**
     * @return Result
     */
    public function whatTimeIsIt()
    {
        return $this->request->get("ping/whattimeisit", $this->parameters->tokenOnly());
    }

    /**
     * @param array $modules
     * @return Result
     */
    public function recentRecords(array $modules)
    {
        return $this->request->get("recent", $this->parameters->tokenOnly());
    }

    /**
     * @return Result
     */
    public function search()
    {
        // TODO: Implement search() method.
    }
}