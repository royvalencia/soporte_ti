<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TipoUbicacionesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TipoUbicacionesTable Test Case
 */
class TipoUbicacionesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TipoUbicacionesTable
     */
    public $TipoUbicaciones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tipo_ubicaciones',
        'app.ubicaciones'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TipoUbicaciones') ? [] : ['className' => TipoUbicacionesTable::class];
        $this->TipoUbicaciones = TableRegistry::get('TipoUbicaciones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TipoUbicaciones);

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
