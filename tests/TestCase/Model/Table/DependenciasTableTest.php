<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DependenciasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DependenciasTable Test Case
 */
class DependenciasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DependenciasTable
     */
    public $Dependencias;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.dependencias'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Dependencias') ? [] : ['className' => DependenciasTable::class];
        $this->Dependencias = TableRegistry::get('Dependencias', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Dependencias);

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
