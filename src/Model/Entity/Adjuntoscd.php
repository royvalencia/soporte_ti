<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Adjuntoscd Entity
 *
 * @property int $adjuntocd_id
 * @property int $vpn_id
 * @property string $descripcion
 * @property string $archivo
 *
 * @property \App\Model\Entity\Vpn $vpn
 */
class Adjuntoscd extends Entity
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
        'vpn_id' => true,
        'descripcion' => true,
        'archivo' => true,
        'vpn' => true
    ];
}
