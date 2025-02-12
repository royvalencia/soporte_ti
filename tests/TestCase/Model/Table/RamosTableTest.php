<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RamosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RamosTable Test Case
 */
class RamosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RamosTable
     */
    public $Ramos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ramos',
        'app.operaciones',
        'app.contratos',
        'app.productos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Ramos') ? [] : ['className' => RamosTable::class];
        $this->Ramos = TableRegistry::get('Ramos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Ramos);

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
