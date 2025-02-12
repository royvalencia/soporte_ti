<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bitacoraservs Model
 *
 * @property \App\Model\Table\ServiciosTable|\Cake\ORM\Association\BelongsTo $Servicios
 *
 * @method \App\Model\Entity\Bitacoraserv get($primaryKey, $options = [])
 * @method \App\Model\Entity\Bitacoraserv newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Bitacoraserv[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bitacoraserv|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bitacoraserv patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Bitacoraserv[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bitacoraserv findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BitacoraservsTable extends Table
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

        $this->setTable('bitacoraservs');
        $this->setDisplayField('bitacoraserv_id');
        $this->setPrimaryKey('bitacoraserv_id');

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
            ->integer('bitacoraserv_id')
            ->allowEmpty('bitacoraserv_id', 'create');

        $validator
            ->scalar('descripcion_evento')
            ->maxLength('descripcion_evento', 100)
            ->requirePresence('descripcion_evento', 'create')
            ->notEmpty('descripcion_evento');

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
        $rules->add($rules->existsIn(['servicio_id'], 'Servicios'));

        return $rules;
    }
}
