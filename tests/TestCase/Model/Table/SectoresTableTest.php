<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SectoresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SectoresTable Test Case
 */
class SectoresTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SectoresTable
     */
    public $Sectores;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sectores',
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
        $config = TableRegistry::exists('Sectores') ? [] : ['className' => SectoresTable::class];
        $this->Sectores = TableRegistry::get('Sectores', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Sectores);

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
