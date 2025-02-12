<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UbicacionesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UbicacionesTable Test Case
 */
class UbicacionesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UbicacionesTable
     */
    public $Ubicaciones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ubicaciones',
        'app.clientes',
        'app.ocupaciones',
        'app.tipo_ubicaciones'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Ubicaciones') ? [] : ['className' => UbicacionesTable::class];
        $this->Ubicaciones = TableRegistry::get('Ubicaciones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Ubicaciones);

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
