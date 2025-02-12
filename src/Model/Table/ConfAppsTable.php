<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ConfApps Model
 *
 * @method \App\Model\Entity\ConfApp get($primaryKey, $options = [])
 * @method \App\Model\Entity\ConfApp newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ConfApp[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ConfApp|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ConfApp patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ConfApp[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ConfApp findOrCreate($search, callable $callback = null, $options = [])
 */
class ConfAppsTable extends Table
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

        $this->setTable('conf_apps');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('campo')
            ->maxLength('campo', 100)
            ->allowEmpty('campo');

        $validator
            ->scalar('valor')
            ->maxLength('valor', 200)
            ->allowEmpty('valor');

        $validator
            ->scalar('descripcion')
            ->maxLength('descripcion', 200)
            ->allowEmpty('descripcion');

        $validator
            ->boolean('valor_estatico')
            ->allowEmpty('valor_estatico');

        return $validator;
    }
}
