<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CatAdscripcione Entity
 *
 * @property int $cat_adscripcione_id
 * @property string $cve_ads
 * @property string $nom_ads
 * @property int $cat_institucione_id
 * @property int $cveusuad
 * @property int $cveucoad
 * @property bool $estatus
 * @property \Cake\I18n\FrozenDate $vigencia_inicial
 * @property \Cake\I18n\FrozenDate $vigencia_final
 * @property string $anio
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\CatInstitucione $cat_institucione
 */
class CatAdscripcione extends Entity
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
        'cve_ads' => true,
        'nom_ads' => true,
        'cat_institucione_id' => true,
        'cveusuad' => true,
        'cveucoad' => true,
        'estatus' => true,
        'vigencia_inicial' => true,
        'vigencia_final' => true,
        'anio' => true,
        /*'num_plaza_titular' => true,
        'num_plaza_superior' => true,*/
        'created' => true,
        'modified' => true,
        'cat_institucione' => true
    ];
}
