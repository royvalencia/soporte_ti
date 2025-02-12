<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CoMenu Entity
 *
 * @property int $co_menu_id
 * @property int $id_padre
 * @property int $posicion
 * @property string $nombre
 * @property string $destino
 * @property string $icono
 * @property string $etiqueta
 *
 * @property \App\Model\Entity\CoGroup[] $co_groups
 */
class CoMenu extends Entity
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
        '*' => true,
        'co_menu_id' => false
    ];
}
