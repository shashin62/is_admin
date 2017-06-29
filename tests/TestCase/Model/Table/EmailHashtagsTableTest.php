<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmailHashtagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmailHashtagsTable Test Case
 */
class EmailHashtagsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EmailHashtagsTable
     */
    public $EmailHashtags;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.email_hashtags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EmailHashtags') ? [] : ['className' => EmailHashtagsTable::class];
        $this->EmailHashtags = TableRegistry::get('EmailHashtags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EmailHashtags);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
