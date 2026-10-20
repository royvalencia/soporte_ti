<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Adjunto Entity
 *
 * @property int $adjunto_id
 * @property int $servicio_id
 * @property string $archivo
 *
 * @property \App\Model\Entity\Servicio $servicio
 */
class Adjunto extends Entity
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
        'comentario_id' => true,
        'descripcion' => true,
        'archivo' => true,
        'servicio' => true
    ];
}
