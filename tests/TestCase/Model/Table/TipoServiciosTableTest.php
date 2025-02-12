<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TipoServiciosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TipoServiciosTable Test Case
 */
class TipoServiciosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TipoServiciosTable
     */
    public $TipoServicios;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tipo_servicios'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TipoServicios') ? [] : ['className' => TipoServiciosTable::class];
        $this->TipoServicios = TableRegistry::get('TipoServicios', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TipoServicios);

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
