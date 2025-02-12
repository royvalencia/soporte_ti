<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TipoClientesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TipoClientesTable Test Case
 */
class TipoClientesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TipoClientesTable
     */
    public $TipoClientes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tipo_clientes',
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
        $config = TableRegistry::exists('TipoClientes') ? [] : ['className' => TipoClientesTable::class];
        $this->TipoClientes = TableRegistry::get('TipoClientes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TipoClientes);

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
