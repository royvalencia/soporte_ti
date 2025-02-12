<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TipoIncidenciasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TipoIncidenciasTable Test Case
 */
class TipoIncidenciasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TipoIncidenciasTable
     */
    public $TipoIncidencias;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tipo_incidencias'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TipoIncidencias') ? [] : ['className' => TipoIncidenciasTable::class];
        $this->TipoIncidencias = TableRegistry::get('TipoIncidencias', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TipoIncidencias);

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
