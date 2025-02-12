<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConductoCobrosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConductoCobrosTable Test Case
 */
class ConductoCobrosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ConductoCobrosTable
     */
    public $ConductoCobros;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.conducto_cobros',
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
        $config = TableRegistry::exists('ConductoCobros') ? [] : ['className' => ConductoCobrosTable::class];
        $this->ConductoCobros = TableRegistry::get('ConductoCobros', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ConductoCobros);

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
