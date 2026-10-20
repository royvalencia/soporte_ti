<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrigenesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrigenesTable Test Case
 */
class OrigenesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\OrigenesTable
     */
    public $Origenes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.origenes',
        'app.vehiculos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Origenes') ? [] : ['className' => OrigenesTable::class];
        $this->Origenes = TableRegistry::get('Origenes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Origenes);

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
