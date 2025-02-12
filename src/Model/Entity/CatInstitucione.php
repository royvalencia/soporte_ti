<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CatInstitucione Entity
 *
 * @property int $id_institucion
 * @property int $num_adscripcion
 * @property int $num_organo
 * @property string $nombre
 * @property int $tipo_institucion_id
 * @property int $estado
 * @property bool $bloquear_funciones
 * @property string $rfc
 * @property int $partida_convertida_sag
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\TipoInstitucion $tipo_institucion
 * @property \App\Model\Entity\CatAdscripcione[] $cat_adscripciones
 */
class CatInstitucione extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'num_adscripcion' => true,
        'num_organo' => true,
        'nombre' => true,
        'tipo_institucion_id' => true,
        'estado' => true,
        'bloquear_funciones' => true,
        'rfc' => true,
        'partida_convertida_sag' => true,
        'created' => true,
        'modified' => true,
        'tipo_institucion' => true,
        'cat_adscripciones' => true
    ];
}
