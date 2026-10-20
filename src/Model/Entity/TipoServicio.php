<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TipoServicio Entity
 *
 * @property int $tipo_servicio_id
 * @property string $descripcion
 * @property int $grupo_id
 */
class TipoServicio extends Entity
{

// virtual field
    protected function _getTipoGrupo()
    {
        return $this->_properties['descripcion'] . ' - '. $this->_properties['grupo']['descripcion'];
    }

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
        'grupo_id' => true
    ];
}
