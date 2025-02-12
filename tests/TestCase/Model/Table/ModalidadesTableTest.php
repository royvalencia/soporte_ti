<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ModalidadesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ModalidadesTable Test Case
 */
class ModalidadesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ModalidadesTable
     */
    public $Modalidades;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.modalidades',
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
        $config = TableRegistry::exists('Modalidades') ? [] : ['className' => ModalidadesTable::class];
        $this->Modalidades = TableRegistry::get('Modalidades', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Modalidades);

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
