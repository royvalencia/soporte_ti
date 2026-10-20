<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Dependencias Model
 *
 * @method \App\Model\Entity\Dependencia get($primaryKey, $options = [])
 * @method \App\Model\Entity\Dependencia newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Dependencia[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Dependencia|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Dependencia patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Dependencia[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Dependencia findOrCreate($search, callable $callback = null, $options = [])
 */
class DependenciasTable extends Table
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

        $this->setTable('dependencias');
        $this->setDisplayField('nombre');
        $this->setPrimaryKey('dependencia_id');

        $this->hasMany('CoUsers', [
            'foreignKey' => 'dependencia_id'
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
            ->integer('dependencia_id')
            ->allowEmpty('dependencia_id', 'create');

        $validator
            ->scalar('nombre')
            ->maxLength('nombre', 255)
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre');

        return $validator;
    }
}
