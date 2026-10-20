<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RecibosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RecibosTable Test Case
 */
class RecibosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RecibosTable
     */
    public $Recibos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.recibos',
        'app.contratos',
        'app.clientes',
        'app.ocupaciones',
        'app.ubicaciones',
        'app.tipo_ubicaciones',
        'app.empresas',
        'app.sectores',
        'app.operaciones',
        'app.ramos',
        'app.productos',
        'app.sub_ramos',
        'app.co_users',
        'app.co_groups',
        'app.co_permissions',
        'app.co_groups_permissions',
        'app.co_menus',
        'app.co_groups_menus',
        'app.centros_capturas',
        'app.activistas',
        'app.municipios',
        'app.centros_municipios',
        'app.tipo_clientes',
        'app.modalidades',
        'app.estatus',
        'app.conducto_cobros',
        'app.monedas',
        'app.forma_pagos',
        'app.vehiculos',
        'app.beneficios',
        'app.beneficios_contratos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Recibos') ? [] : ['className' => RecibosTable::class];
        $this->Recibos = TableRegistry::get('Recibos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Recibos);

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
