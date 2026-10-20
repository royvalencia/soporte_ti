<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DireccionesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DireccionesTable Test Case
 */
class DireccionesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DireccionesTable
     */
    public $Direcciones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.direcciones'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Direcciones') ? [] : ['className' => DireccionesTable::class];
        $this->Direcciones = TableRegistry::get('Direcciones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Direcciones);

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
