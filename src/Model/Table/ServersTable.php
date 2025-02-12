<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Servers Model
 * @property \App\Model\Table\CoUsers|\Cake\ORM\Association\BelongsTo $coUsers

 *
 * @method \App\Model\Entity\Server get($primaryKey, $options = [])
 * @method \App\Model\Entity\Server newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Server[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Server|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Server patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Server[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Server findOrCreate($search, callable $callback = null, $options = [])
 */
class ServersTable extends Table
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

        $this->setTable('servers');
        $this->setDisplayField('server_id');
        $this->setPrimaryKey('server_id');

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
            ->integer('server_id')
            ->allowEmpty('server_id', 'create');

        $validator
            ->scalar('descripcion')
            ->allowEmpty('descripcion');

        $validator
            ->scalar('user')
            ->allowEmpty('user');

        $validator
            ->scalar('password')
            ->maxLength('password', 100)
            ->allowEmpty('password');

        $validator
            ->scalar('ip_interna')
            ->maxLength('ip_interna', 100)
            ->allowEmpty('ip_interna');

        $validator
            ->scalar('ip_externa')
            ->maxLength('ip_externa', 100)
            ->allowEmpty('ip_externa');

        $validator
            ->scalar('caracteristicas')
            ->maxLength('caracteristicas', 100)
            ->allowEmpty('caracteristicas');

        $validator
            ->scalar('servicios')
            ->allowEmpty('servicios');

        $validator
            ->scalar('puertos')
            ->maxLength('puertos', 100)
            ->allowEmpty('puertos');

        $validator
            ->scalar('co_user_id')
            ->notEmpty('co_user_id');

        return $validator;
    }
}
