<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Banip Model
 * @property \App\Model\Table\CoUsers|\Cake\ORM\Association\BelongsTo $coUsers

 *
 * @method \App\Model\Entity\Banip get($primaryKey, $options = [])
 * @method \App\Model\Entity\Banip newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Banip[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Banip|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Banip patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Banip[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Banip findOrCreate($search, callable $callback = null, $options = [])
 */
class BanipTable extends Table
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

        $this->setTable('banip');
        $this->setDisplayField('banip_id');
        $this->setPrimaryKey('banip_id');

        $this->belongsTo('CoUsers',[
            'foreignKey' => 'co_user_id',
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
            ->integer('banip_id')
            ->allowEmpty('banip_id', 'create');

        $validator
            ->scalar('ip')
            ->maxLength('ip', 50)
            ->allowEmpty('ip');

        $validator
            ->scalar('amenanza')
            ->maxLength('amenanza', 255)
            ->allowEmpty('amenanza');

        $validator
            ->scalar('fuente')
            ->maxLength('fuente', 50)
            ->allowEmpty('fuente');

        $validator
            ->scalar('destinofin')
            ->maxLength('destinofin', 50)
            ->allowEmpty('destinofin');

        $validator
            ->dateTime('fecha_hora')
            ->allowEmpty('fecha_hora');

        $validator
            ->scalar('co_user_id')
            ->notEmpty('co_user_id');

        return $validator;
    }
}
