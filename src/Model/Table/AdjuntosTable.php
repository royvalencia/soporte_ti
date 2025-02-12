<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Adjuntos Model
 *
 * @property \App\Model\Table\ServiciosTable|\Cake\ORM\Association\BelongsTo $Servicios
 *
 * @method \App\Model\Entity\Adjunto get($primaryKey, $options = [])
 * @method \App\Model\Entity\Adjunto newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Adjunto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Adjunto|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Adjunto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Adjunto[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Adjunto findOrCreate($search, callable $callback = null, $options = [])
 */
class AdjuntosTable extends Table
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

        $this->setTable('adjuntos');
        $this->setDisplayField('adjunto_id');
        $this->setPrimaryKey('adjunto_id');

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
            ->integer('adjunto_id')
            ->allowEmpty('adjunto_id', 'create');

        

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
