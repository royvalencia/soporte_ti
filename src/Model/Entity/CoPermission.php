<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Mascota Entity
 *
 * @property int $id
 * @property int $propietario_id
 * @property int $tipo_mascota_id
 * @property string $nombre
 * @property \Cake\I18n\Time $fecha_nacimiento
 * @property string $raza
 * @property string $sexo
 * @property string $color
 * @property string $no_chip
 * @property string $senas_particulares
 * @property string $foto
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $login
 *
 * @property \App\Model\Entity\Propietario $propietario
 * @property \App\Model\Entity\TipoMascota $tipo_mascota
 * @property \App\Model\Entity\Expediente[] $expedientes
 */
class CoPermission extends Entity
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
        'co_permission_id' => false
    ];
}
