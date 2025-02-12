<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TipoServicios Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $Grupos
 *
 * @method \App\Model\Entity\TipoServicio get($primaryKey, $options = [])
 * @method \App\Model\Entity\TipoServicio newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TipoServicio[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TipoServicio|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TipoServicio patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TipoServicio[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TipoServicio findOrCreate($search, callable $callback = null, $options = [])
 */
class TipoServiciosTable extends Table
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

        $this->setTable('tipo_servicios');
        //$this->setDisplayField('tipo_grupo');
        $this->setDisplayField('descripcion');
        $this->setPrimaryKey('tipo_servicio_id');

        $this->belongsTo('Grupos', [
            'foreignKey' => 'grupo_id',
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
            ->integer('tipo_servicio_id')
            ->allowEmpty('tipo_servicio_id', 'create');

        $validator
            ->scalar('descripcion')
            ->maxLength('descripcion', 150)
            ->requirePresence('descripcion', 'create')
            ->notEmpty('descripcion');

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
        $rules->add($rules->existsIn(['grupo_id'], 'Grupos'));

        return $rules;
    }
}
