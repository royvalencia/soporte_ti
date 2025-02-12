<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Prioridades Model
 *
 * @method \App\Model\Entity\Prioridade get($primaryKey, $options = [])
 * @method \App\Model\Entity\Prioridade newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Prioridade[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Prioridade|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Prioridade patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Prioridade[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Prioridade findOrCreate($search, callable $callback = null, $options = [])
 */
class PrioridadesTable extends Table
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

        $this->setTable('prioridades');
        $this->setDisplayField('descripcion');
        $this->setPrimaryKey('prioridade_id');
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
            ->integer('prioridade_id')
            ->allowEmpty('prioridade_id', 'create');

        $validator
            ->scalar('descripcion')
            ->maxLength('descripcion', 100)
            ->requirePresence('descripcion', 'create')
            ->notEmpty('descripcion');

        return $validator;
    }
}
