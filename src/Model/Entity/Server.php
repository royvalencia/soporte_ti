<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Server Entity
 *
 * @property int $server_id
 * @property string $descripcion
 * @property string $user
 * @property string $password
 * @property string $ip_interna
 * @property string $ip_externa
 * @property string $caracteristicas
 * @property string $servicios
 * @property string $puertos
 * @property int $co_user_id

 */
class Server extends Entity
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
        'descripcion' => true,
        'user' => true,
        'password' => true,
        'ip_interna' => true,
        'ip_externa' => true,
        'caracteristicas' => true,
        'servicios' => true,
        'puertos' => true,
        'co_user_id' => true

    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [];
}
