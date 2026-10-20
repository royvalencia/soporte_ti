<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bitacoraserv Entity
 *
 * @property int $bitacoraserv_id
 * @property int $servicio_id
 * @property string $descripcion_evento
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Servicio $servicio
 */
class Bitacoraserv extends Entity
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
        'servicio_id' => true,
        'descripcion_evento' => true,
        'created' => true,
        'servicio' => true
    ];
}
