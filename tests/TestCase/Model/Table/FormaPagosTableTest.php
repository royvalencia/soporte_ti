<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FormaPagosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FormaPagosTable Test Case
 */
class FormaPagosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FormaPagosTable
     */
    public $FormaPagos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.forma_pagos',
        'app.contratos',
        'app.recibos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('FormaPagos') ? [] : ['className' => FormaPagosTable::class];
        $this->FormaPagos = TableRegistry::get('FormaPagos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FormaPagos);

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
