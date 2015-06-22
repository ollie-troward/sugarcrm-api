<?php namespace spec\Troward\SugarAPI;

/**
 * Class OtherSpec
 * @package spec\Troward\SugarAPI
 */
class OtherSpec extends BaseSpec
{
    /**
     * A valid record id.
     *
     * @var string
     */
    protected $validRecordId;

    /**
     * A valid record name.
     *
     * @var string
     */
    protected $validRecordName;

    /**
     * A valid file field.
     *
     * @var string
     */
    protected $validFileField;

    /**
     * A valid file record id.
     *
     * @var string
     */
    protected $validFileRecordId;

    /**
     *
     */
    function __construct()
    {
        parent::__construct();
        $this->setEnvVariables();
    }

    /**
     *
     */
    private function setEnvVariables()
    {
        $this->validRecordId = getenv('valid_account_id');
        $this->validRecordName = getenv('valid_account_name');
        $this->validFileRecordId = getenv('valid_file_record_id');
    }

    /**
     *
     */
    function it_is_initializable()
    {
        $this->shouldHaveType('Troward\SugarAPI\Other');
    }

    /**
     *
     */
    function let()
    {
        $this->beConstructedWith($this->request, $this->parameters);
    }

    /**
     * It retrieves the most active users with a day limit
     */
    function it_retrieves_most_active_users()
    {
        $days = 120;
        $this->mostActiveUsers($days)
            ->shouldReturnAnInstanceOf('GuzzleHttp\Message\Response');
    }

    /**
     * It pings the server
     */
    function it_pings_the_server()
    {
        $this->ping()
            ->shouldReturnAnInstanceOf('GuzzleHttp\Message\Response');
    }

    /**
     * It checks the time of the ping
     */
    function it_checks_the_ping_time()
    {
        $this->whatTimeIsIt()
            ->shouldReturnAnInstanceOf('GuzzleHttp\Message\Response');
    }
}