<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Solicitantes Model
 *
 * @method \App\Model\Entity\Solicitante get($primaryKey, $options = [])
 * @method \App\Model\Entity\Solicitante newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Solicitante[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Solicitante|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Solicitante patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Solicitante[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Solicitante findOrCreate($search, callable $callback = null, $options = [])
 */
class SolicitantesTable extends Table
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

        $this->setTable('solicitantes');
        $this->setDisplayField('nombre');
        $this->setPrimaryKey('solicitante_id');
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
            ->integer('solicitante_id')
            ->allowEmpty('solicitante_id', 'create');

        $validator
            ->scalar('nombre')
            ->maxLength('nombre', 255)
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre');

        return $validator;
    }
}
