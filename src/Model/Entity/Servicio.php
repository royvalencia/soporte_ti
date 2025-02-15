<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Servicio Entity
 *
 * @property int $servicio_id
 * @property string $asunto
 * @property string $descripcion
 * @property int $statu_id
 * @property int $fuente
 * @property int $prioridade_id
 * @property \Cake\I18n\FrozenTime $fecha_creacion
 * @property int $tipo_incidencia_id
 * @property int $co_group_id
 * @property int $dependencia_id
 * @property int $direccione_id
 * @property int $solicitante_id
 * @property int $grupo_id
 * @property int $co_user_id
 * @property int $agente
 * @property int $estado
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Status $status
 * @property \App\Model\Entity\Prioridade $prioridade
 * @property \App\Model\Entity\TipoIncidencia $tipo_incidencia
 * @property \App\Model\Entity\CoGroup $co_group
 * @property \App\Model\Entity\Dependencia $dependencia
 * @property \App\Model\Entity\Direccione $direccione
 * @property \App\Model\Entity\Solicitante $solicitante
 * @property \App\Model\Entity\Grupo $grupo
 * @property \App\Model\Entity\CoUser $co_user
 */
class Servicio extends Entity
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
        'asunto' => true,
        'descripcion' => true,
        'statu_id' => true,
        'fuente' => true,
        'prioridade_id' => true,
        'fecha_creacion' => true,
        'tipo_incidencia_id' => true,
        'co_group_id' => true,
        'dependencia_id' => true,
        'direccione_id' => true,
        'solicitante_id' => true,
        'grupo_id' => true,
        'co_user_id' => true,
        'agente' => true,
        'created' => true,
        'modified' => true,
        'status' => true,
        'prioridade' => true,
        'tipo_incidencia' => true,
        'co_group' => true,
        'dependencia' => true,
        'direccione' => true,
        'solicitante' => true,
        'grupo' => true,
        'referencia' => true,
        'co_user' => true,
        'estado' => true
    ];
}
