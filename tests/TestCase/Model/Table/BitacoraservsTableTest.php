<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BitacoraservsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BitacoraservsTable Test Case
 */
class BitacoraservsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BitacoraservsTable
     */
    public $Bitacoraservs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.bitacoraservs',
        'app.servicios'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Bitacoraservs') ? [] : ['className' => BitacoraservsTable::class];
        $this->Bitacoraservs = TableRegistry::get('Bitacoraservs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Bitacoraservs);

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
