<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ServiciosController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ServiciosController Test Case
 */
class ServiciosControllerTest extends IntegrationTestCase
{

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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
