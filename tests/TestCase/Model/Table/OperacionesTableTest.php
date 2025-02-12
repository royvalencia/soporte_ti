<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OperacionesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OperacionesTable Test Case
 */
class OperacionesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\OperacionesTable
     */
    public $Operaciones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.operaciones',
        'app.contratos',
        'app.ramos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Operaciones') ? [] : ['className' => OperacionesTable::class];
        $this->Operaciones = TableRegistry::get('Operaciones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Operaciones);

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
