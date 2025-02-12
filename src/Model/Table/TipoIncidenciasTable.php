<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TipoIncidencias Model
 *
 * @method \App\Model\Entity\TipoIncidencia get($primaryKey, $options = [])
 * @method \App\Model\Entity\TipoIncidencia newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TipoIncidencia[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TipoIncidencia|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TipoIncidencia patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TipoIncidencia[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TipoIncidencia findOrCreate($search, callable $callback = null, $options = [])
 */
class TipoIncidenciasTable extends Table
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

        $this->setTable('tipo_incidencias');
        $this->setDisplayField('descripcion');
        $this->setPrimaryKey('tipo_incidencia_id');
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
            ->integer('tipo_incidencia_id')
            ->allowEmpty('tipo_incidencia_id', 'create');

        $validator
            ->scalar('descripcion')
            ->maxLength('descripcion', 100)
            ->requirePresence('descripcion', 'create')
            ->notEmpty('descripcion');

        return $validator;
    }
}
