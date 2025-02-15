<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Comentario Entity
 *
 * @property int $comentario_id
 * @property int $servicio_id
 * @property string $texto
 * @property int $co_user_id
 * @property int $tipo
 * @property int $usuario_notificar
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Servicio $servicio
 * @property \App\Model\Entity\CoUser $co_user
 */
class Comentario extends Entity
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
        'texto' => true,
        'co_user_id' => true,
        'tipo' => true,
        'usuario_notificar' => true,
        'created' => true,
        'modified' => true,
        'servicio' => true,
        'co_user' => true
    ];
}
