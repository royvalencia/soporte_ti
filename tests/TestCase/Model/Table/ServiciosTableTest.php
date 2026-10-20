<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ServiciosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ServiciosTable Test Case
 */
class ServiciosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ServiciosTable
     */
    public $Servicios;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.servicios',
        'app.status',
        'app.prioridades',
        'app.tipo_incidencias',
        'app.co_groups',
        'app.dependencias',
        'app.direcciones',
        'app.solicitantes',
        'app.grupos',
        'app.co_users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Servicios') ? [] : ['className' => ServiciosTable::class];
        $this->Servicios = TableRegistry::get('Servicios', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Servicios);

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
