<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CatInstitucionesFixture
 *
 */
class CatInstitucionesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id_institucion' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'num_adscripcion' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'num_organo' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'nombre' => ['type' => 'string', 'length' => 150, 'null' => false, 'default' => null, 'collate' => 'latin1_spanish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'tipo_institucion_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'estado' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'bloquear_funciones' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'rfc' => ['type' => 'string', 'length' => 13, 'null' => true, 'default' => null, 'collate' => 'utf8_spanish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'partida_convertida_sag' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id_institucion'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'MyISAM',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id_institucion' => 1,
                'num_adscripcion' => 1,
                'num_organo' => 1,
                'nombre' => 'Lorem ipsum dolor sit amet',
                'tipo_institucion_id' => 1,
                'estado' => 1,
                'bloquear_funciones' => 1,
                'rfc' => 'Lorem ipsum',
                'partida_convertida_sag' => 1,
                'created' => '2018-08-14 10:28:56',
                'modified' => '2018-08-14 10:28:56'
            ],
        ];
        parent::init();
    }
}
