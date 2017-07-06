<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AcoMastersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AcoMastersTable Test Case
 */
class AcoMastersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AcoMastersTable
     */
    public $AcoMasters;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.aco_masters'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AcoMasters') ? [] : ['className' => AcoMastersTable::class];
        $this->AcoMasters = TableRegistry::get('AcoMasters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AcoMasters);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
