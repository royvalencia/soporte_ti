<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CatAdscripcionesFixture
 *
 */
class CatAdscripcionesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'cat_adscripcione_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'cve_ads' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'utf8_spanish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'nom_ads' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'collate' => 'utf8_spanish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'cat_institucione_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'cveusuad' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'cveucoad' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'estatus' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null],
        'vigencia_inicial' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'vigencia_final' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'anio' => ['type' => 'string', 'length' => null, 'null' => true, 'default' => null, 'collate' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['cat_adscripcione_id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'MyISAM',
            'collation' => 'utf8_spanish_ci'
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
                'cat_adscripcione_id' => 1,
                'cve_ads' => 'Lorem ipsum dolor sit amet',
                'nom_ads' => 'Lorem ipsum dolor sit amet',
                'cat_institucione_id' => 1,
                'cveusuad' => 1,
                'cveucoad' => 1,
                'estatus' => 1,
                'vigencia_inicial' => '2018-08-14',
                'vigencia_final' => '2018-08-14',
                'anio' => 'Lorem ipsum dolor sit amet',
                'created' => '2018-08-14 11:07:07',
                'modified' => '2018-08-14 11:07:07'
            ],
        ];
        parent::init();
    }
}
