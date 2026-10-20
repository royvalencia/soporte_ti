<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OcupacionesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OcupacionesTable Test Case
 */
class OcupacionesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\OcupacionesTable
     */
    public $Ocupaciones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ocupaciones',
        'app.clientes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Ocupaciones') ? [] : ['className' => OcupacionesTable::class];
        $this->Ocupaciones = TableRegistry::get('Ocupaciones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Ocupaciones);

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
