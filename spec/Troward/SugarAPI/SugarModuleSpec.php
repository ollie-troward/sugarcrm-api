<?php namespace spec\Troward\SugarAPI;

/**
 * Class SugarModuleSpec
 * @package spec\Troward\SugarAPI
 */
class SugarModuleSpec extends BaseSpec
{
    /**
     * @var string
     */
    protected $module = "Accounts";

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
    function let()
    {
        $this->beConstructedWith($this->module);
    }

    /**
     *
     */
    function it_is_initializable()
    {
        $this->shouldHaveType('Troward\SugarAPI\SugarModule');
    }

    /**
     * Retrieve all records via all()
     */
    function it_retrieves_all_records_with_a_limit()
    {
        $limit = 10;
        $this->all($limit)->shouldReturnAnInstanceOf('GuzzleHttp\Message\Response');
    }

    /**
     * Retrieves all records via get()
     */
    function it_gets_all_records_with_a_limit()
    {
        $limit = 10;
        $this->get($limit)->shouldReturnAnInstanceOf('GuzzleHttp\Message\Response');
    }

    /**
     * Retrieve the first record
     */
    function it_retrieves_the_first_record()
    {
        $this->find('id', $this->validRecordId)->shouldReturnAnInstanceOf('GuzzleHttp\Message\Response');
    }

    /**
     * Fails to retrieve any record
     */
    function it_fails_to_retrieve_any_records()
    {
        $this->find('id', 'not_valid_id')->shouldReturnAnInstanceOf('GuzzleHttp\Message\Response');
    }

    /**
     * Allows filtering
     */
    function it_allows_multiple_filters_and_returns_a_record()
    {
        $this->where('name', $this->validRecordName)
            ->where('id', $this->validRecordId)
            ->get()
            ->shouldReturnAnInstanceOf('GuzzleHttp\Message\Response');
    }

    /**
     * Allows filtering with OR and AND
     */
    function it_allows_multiple_filters_with_and_or_clauses_and_returns_a_record()
    {
        $this->where('name', $this->validRecordName)
            ->orWhere('id', $this->validRecordId)
            ->get()
            ->shouldReturnAnInstanceOf('GuzzleHttp\Message\Response');
    }

    /**
     * You can subscribe to a record
     */
    function it_can_subscribe_to_a_record()
    {
        $this->subscribe($this->validRecordId)
            ->shouldReturnAnInstanceOf('GuzzleHttp\Message\Response');
    }

    /**
     * You can unsubscribe to a record
     */
    function it_can_unsubscribe_to_a_record()
    {
        $this->unsubscribe($this->validRecordId)
            ->shouldReturnAnInstanceOf('GuzzleHttp\Message\Response');
    }

    /**
     * You can favorite a record
     */
    function it_can_favorite_a_record()
    {
        $this->favorite($this->validRecordId)
            ->shouldReturnAnInstanceOf('GuzzleHttp\Message\Response');
    }

    /**
     * You can unfavorite a record
     */
    function it_can_unfavorite_a_record()
    {
        $this->unfavorite($this->validRecordId)
            ->shouldReturnAnInstanceOf('GuzzleHttp\Message\Response');
    }

    /**
     * TODO
     */
    function it_can_create_a_record_list()
    {
        // return $this->postRequest($this->module . "/record_list/", $this->buildRecordListParameters($records, $this->token()));
        // $this->createRecordList()->shouldReturnAnInstanceOf('GuzzleHttp\Message\Response');
    }

    /**
     * TODO
     */
    function it_can_retrieve_a_record_list()
    {
        // return $this->getRequest($this->module . "/record_list/" . $recordListId, $this->buildParameters($limit, [], $fields, $orderBy, $this->token()));
        // $this->getRecordListById($this->recordListId)->shouldReturnAnInstanceOf('GuzzleHttp\Message\Response');
    }

    /**
     * Retrieves a file listing for a record
     */
    function it_can_retrieve_a_file_list()
    {
        $this->module = "Notes";
        $this->let();

        $this->getFileList($this->validFileRecordId)
            ->shouldReturnAnInstanceOf('GuzzleHttp\Message\Response');
    }

    /**
     * It can save a file
     */
    function it_can_upload_a_file()
    {
        $this->module = "Notes";
        $this->let();

        $sourcePath = 'storage/test.txt';

        $this->uploadFile($this->validFileRecordId, $sourcePath)
            ->shouldReturnAnInstanceOf('GuzzleHttp\Message\Response');
    }

    /**
     * It can fetch a file
     */
    function it_can_download_a_file()
    {
        $this->module = "Notes";
        $this->let();

        $destinationPath = 'storage/retrieved.txt';

        $this->downloadFile($this->validFileRecordId, $destinationPath)
            ->shouldReturnAnInstanceOf('GuzzleHttp\Message\Response');
    }

    /**
     * It can delete a file
     */
    function it_can_delete_a_file()
    {
        $this->module = "Notes";
        $this->let();

        $this->deleteFile($this->validFileRecordId)
            ->shouldReturnAnInstanceOf('GuzzleHttp\Message\Response');
    }

    /**
     * It can find related records based on module
     */
    function it_can_get_a_related_module()
    {
        $this->getRelation($this->validRecordId, "Notes")
            ->shouldReturnAnInstanceOf('GuzzleHttp\Message\Response');
    }

    /**
     * It can set related records based on module
     */
    function it_can_set_a_related_module()
    {
        $this->setRelation($this->validRecordId, "Notes", $this->validFileRecordId)
            ->shouldReturnAnInstanceOf('GuzzleHttp\Message\Response');
    }

    /**
     * It can retrieve an audit log for a record
     */
    function it_can_retrieve_an_audit_log()
    {
        $this->changeLog($this->validRecordId)
            ->shouldReturnAnInstanceOf('GuzzleHttp\Message\Response');
    }
}