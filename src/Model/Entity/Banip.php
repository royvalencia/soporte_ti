<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Banip Entity
 *
 * @property int $banip_id
 * @property string $ip
 * @property string $amenanza
 * @property string $fuente
 * @property string $destinofin
 * @property \Cake\I18n\FrozenTime $fecha_hora
 * @property int $co_user_id
 */
class Banip extends Entity
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
        'ip' => true,
        'amenanza' => true,
        'fuente' => true,
        'destinofin' => true,
        'fecha_hora' => true,
        'co_user_id' => true

    ];
}
