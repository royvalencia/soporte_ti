<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bitacoras Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Bitacoras
 *
 * @method \App\Model\Entity\Bitacora get($primaryKey, $options = [])
 * @method \App\Model\Entity\Bitacora newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Bitacora[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bitacora|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bitacora patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Bitacora[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bitacora findOrCreate($search, callable $callback = null, $options = [])
 */
class BitacorasTable extends Table
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

        $this->table('bitacoras');
        $this->displayField('bitacora_id');
        $this->primaryKey('bitacora_id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Servicios', [
            'foreignKey' => 'servicio_id',
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
            ->allowEmpty('usuario');

        $validator
            ->allowEmpty('ip');

        $validator
            ->dateTime('fecha')
            ->allowEmpty('fecha');

        $validator
            ->allowEmpty('descripcion');

        $validator
            ->integer('referencia')
            ->allowEmpty('referencia');

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
        //$rules->add($rules->existsIn(['bitacora_id'], 'Bitacoras'));

        return $rules;
    }
}
