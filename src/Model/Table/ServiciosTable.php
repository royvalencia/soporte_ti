<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Servicios Model
 *
 * @property \App\Model\Table\StatusTable|\Cake\ORM\Association\BelongsTo $Status
 * @property \App\Model\Table\PrioridadesTable|\Cake\ORM\Association\BelongsTo $Prioridades
 * @property \App\Model\Table\TipoIncidenciasTable|\Cake\ORM\Association\BelongsTo $TipoIncidencias
 * @property \App\Model\Table\CoGroupsTable|\Cake\ORM\Association\BelongsTo $CoGroups
 * @property \App\Model\Table\DependenciasTable|\Cake\ORM\Association\BelongsTo $Dependencias
 * @property \App\Model\Table\DireccionesTable|\Cake\ORM\Association\BelongsTo $Direcciones
 * @property \App\Model\Table\SolicitantesTable|\Cake\ORM\Association\BelongsTo $Solicitantes
 * @property \App\Model\Table\GruposTable|\Cake\ORM\Association\BelongsTo $Grupos
 * @property \App\Model\Table\CoUsersTable|\Cake\ORM\Association\BelongsTo $CoUsers
 *
 * @method \App\Model\Entity\Servicio get($primaryKey, $options = [])
 * @method \App\Model\Entity\Servicio newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Servicio[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Servicio|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Servicio patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Servicio[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Servicio findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ServiciosTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('servicios');
        $this->setDisplayField('servicio_id');
        $this->setPrimaryKey('servicio_id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Status', [
            'foreignKey' => 'statu_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Prioridades', [
            'foreignKey' => 'prioridade_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('TipoIncidencias', [
            'foreignKey' => 'tipo_incidencia_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CoGroups', [
            'foreignKey' => 'co_group_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Dependencias', [
            'foreignKey' => 'dependencia_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Direcciones', [
            'foreignKey' => 'direccione_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Solicitantes', [
            'foreignKey' => 'solicitante_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Grupos', [
            'foreignKey' => 'grupo_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CoUsers', [
            'foreignKey' => 'co_user_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('servicio_id')
            ->allowEmpty('servicio_id', 'create');

        $validator
            ->scalar('asunto')
            ->maxLength('asunto', 255)
            ->requirePresence('asunto', 'create')
            ->notEmpty('asunto');

        $validator
            ->scalar('descripcion')
            ->maxLength('descripcion', 4294967295)
            ->requirePresence('descripcion', 'create')
            ->notEmpty('descripcion');

        $validator
            ->integer('fuente')
            ->requirePresence('fuente', 'create')
            ->notEmpty('fuente');

        $validator
            ->dateTime('fecha_creacion')
            ->requirePresence('fecha_creacion', 'create')
            ->notEmpty('fecha_creacion');

        $validator
            ->integer('agente')
            ->requirePresence('agente', 'create')
            ->notEmpty('agente');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['statu_id'], 'Status'));
        $rules->add($rules->existsIn(['prioridade_id'], 'Prioridades'));
        $rules->add($rules->existsIn(['tipo_incidencia_id'], 'TipoIncidencias'));
        $rules->add($rules->existsIn(['co_group_id'], 'CoGroups'));
        $rules->add($rules->existsIn(['dependencia_id'], 'Dependencias'));
        $rules->add($rules->existsIn(['direccione_id'], 'Direcciones'));
        $rules->add($rules->existsIn(['solicitante_id'], 'Solicitantes'));
        $rules->add($rules->existsIn(['grupo_id'], 'Grupos'));
        $rules->add($rules->existsIn(['co_user_id'], 'CoUsers'));

        return $rules;
    }
}
