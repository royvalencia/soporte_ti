<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Vpns Model
 * @property \App\Model\Table\CatInstituciones|\Cake\ORM\Association\BelongsTo $CatInstituciones
 * @property \App\Model\Table\CoUsers|\Cake\ORM\Association\BelongsTo $coUsers


 * 
 * @method \App\Model\Entity\Vpn get($primaryKey, $options = [])
 * @method \App\Model\Entity\Vpn newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Vpn[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Vpn|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Vpn patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Vpn[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Vpn findOrCreate($search, callable $callback = null, $options = [])
 */
class VpnsTable extends Table
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

        $this->setTable('vpns');
        $this->setDisplayField('vpn_id');
        $this->setPrimaryKey('vpn_id');

        $this->belongsTo('CatInstituciones', [
            'foreignKey' => 'cat_institucione_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CoUsers',[
            'foreignKey' => 'co_user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Adjuntoscd', [
            'foreignKey' => 'vpn_id',
            'joinType' => 'INNER',
            'dependent' => false
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
            ->allowEmpty('vpn_id', 'create');

        $validator
            ->scalar('responsable')
            ->maxLength('responsable', 50)
            ->allowEmpty('responsable');

        $validator
            ->date('fecha_entrega')
            ->allowEmpty('fecha_entrega');
            
        $validator
            ->scalar('cat_institucione_id')
            ->notEmpty('cat_institucione_id');

        $validator
            ->scalar('usuario')
            ->maxLength('usuario', 50)
            ->allowEmpty('usuario');

        $validator
            ->scalar('pass')
            ->allowEmpty('pass');

        $validator
            ->scalar('observaciones')
            ->allowEmpty('observaciones');
        
        $validator
            ->scalar('co_user_id')
            ->notEmpty('co_user_id');

        return $validator;
    }
}
