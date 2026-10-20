<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContratosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContratosTable Test Case
 */
class ContratosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ContratosTable
     */
    public $Contratos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        'app.recibos',
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
        $config = TableRegistry::exists('Contratos') ? [] : ['className' => ContratosTable::class];
        $this->Contratos = TableRegistry::get('Contratos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Contratos);

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
