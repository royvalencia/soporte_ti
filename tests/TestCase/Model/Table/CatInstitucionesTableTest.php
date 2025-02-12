<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CatInstitucionesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CatInstitucionesTable Test Case
 */
class CatInstitucionesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CatInstitucionesTable
     */
    public $CatInstituciones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cat_instituciones',
        'app.tipo_institucions',
        'app.cat_adscripciones'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CatInstituciones') ? [] : ['className' => CatInstitucionesTable::class];
        $this->CatInstituciones = TableRegistry::get('CatInstituciones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CatInstituciones);

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
