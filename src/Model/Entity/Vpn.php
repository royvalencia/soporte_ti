<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Vpn Entity
 *
 * @property int $vpn_id
 * @property string $responsable
 * @property \Cake\I18n\FrozenDate $fecha_entrega
 * @property int $cat_adscripcione_id
 * @property string $usuario
 * @property string $pass
 * @property string $observaciones
 * @property int $co_user_id

 */
class Vpn extends Entity
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
        'responsable' => true,
        'fecha_entrega' => true,
        'cat_institucione_id' => true,
        'usuario' => true,
        'pass' => true,
        'observaciones' => true,
        'co_user_id' => true
    ];
}
