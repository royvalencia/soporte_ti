<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CatInstituciones Model
 *
 * @property \App\Model\Table\TipoInstitucionsTable|\Cake\ORM\Association\BelongsTo $TipoInstitucions
 * @property \App\Model\Table\CatAdscripcionesTable|\Cake\ORM\Association\HasMany $CatAdscripciones
 *
 * @method \App\Model\Entity\CatInstitucione get($primaryKey, $options = [])
 * @method \App\Model\Entity\CatInstitucione newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CatInstitucione[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CatInstitucione|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CatInstitucione patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CatInstitucione[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CatInstitucione findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CatInstitucionesTable extends Table
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

        $this->setTable('cat_instituciones');
        $this->setDisplayField('nombre');
        $this->setPrimaryKey('cat_institucione_id');

        $this->addBehavior('Timestamp');


        $this->hasMany('CatAdscripciones', [
            'foreignKey' => 'cat_institucione_id'
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
            ->integer('cat_institucione_id')
            ->allowEmpty('cat_institucione_id', 'create');

        $validator
            ->integer('num_adscripcion')
            ->requirePresence('num_adscripcion', 'create')
            ->notEmpty('num_adscripcion');

        $validator
            ->integer('num_organo')
            ->requirePresence('num_organo', 'create')
            ->notEmpty('num_organo');

        $validator
            ->scalar('nombre')
            ->maxLength('nombre', 150)
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre');

        $validator
            ->integer('estado')
            ->requirePresence('estado', 'create')
            ->notEmpty('estado');

        $validator
            ->boolean('bloquear_funciones')
            ->requirePresence('bloquear_funciones', 'create')
            ->notEmpty('bloquear_funciones');

        $validator
            ->scalar('rfc')
            ->maxLength('rfc', 13)
            ->allowEmpty('rfc');

        $validator
            ->integer('partida_convertida_sag')
            ->allowEmpty('partida_convertida_sag');

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
        $rules->add($rules->existsIn(['tipo_institucion_id'], 'TipoInstitucions'));

        return $rules;
    }
}
