<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SubRamosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SubRamosTable Test Case
 */
class SubRamosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SubRamosTable
     */
    public $SubRamos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sub_ramos',
        'app.productos',
        'app.ramos',
        'app.operaciones',
        'app.contratos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SubRamos') ? [] : ['className' => SubRamosTable::class];
        $this->SubRamos = TableRegistry::get('SubRamos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SubRamos);

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
