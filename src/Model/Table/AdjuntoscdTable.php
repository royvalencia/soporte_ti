<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Adjuntoscd Model
 *
 * @property \App\Model\Table\VpnsTable|\Cake\ORM\Association\BelongsTo $Vpns
 *
 * @method \App\Model\Entity\Adjuntoscd get($primaryKey, $options = [])
 * @method \App\Model\Entity\Adjuntoscd newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Adjuntoscd[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Adjuntoscd|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Adjuntoscd patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Adjuntoscd[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Adjuntoscd findOrCreate($search, callable $callback = null, $options = [])
 */
class AdjuntoscdTable extends Table
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

        $this->setTable('adjuntoscd');
        $this->setDisplayField('adjuntocd_id');
        $this->setPrimaryKey('adjuntocd_id');

        $this->belongsTo('Vpns', [
            'foreignKey' => 'vpn_id',
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
            ->integer('adjuntocd_id')
            ->allowEmpty('adjuntocd_id', 'create');

        $validator
            ->scalar('descripcion')
            ->maxLength('descripcion', 100)
            ->allowEmpty('descripcion');

        $validator
            ->scalar('archivo')
            ->maxLength('archivo', 255)
            ->allowEmpty('archivo');

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
        $rules->add($rules->existsIn(['vpn_id'], 'Vpns'));

        return $rules;
    }
}
