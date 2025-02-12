<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CoMenus Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CoMenus
 *
 * @method \App\Model\Entity\CoMenu get($primaryKey, $options = [])
 * @method \App\Model\Entity\CoMenu newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CoMenu[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CoMenu|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CoMenu patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CoMenu[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CoMenu findOrCreate($search, callable $callback = null)
 */
class CoMenusTable extends Table
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

        $this->table('co_menus');
        $this->displayField('nombre');
        $this->primaryKey('co_menu_id');

        $this->belongsTo('CoMenus', [
            'foreignKey' => 'co_menu_id',
            'joinType' => 'INNER'
        ]);
        
         $this->belongsToMany('CoGroups', [
            'joinTable' => 'co_groups_menus',
            'foreignKey'=>'co_menu_id'    ,
            'targetForeignKey'=>'co_group_id'
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
            ->integer('id_padre')
            ->requirePresence('id_padre', 'create')
            ->notEmpty('id_padre');

        $validator
            ->integer('posicion')
            ->allowEmpty('posicion');

        $validator
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre');

        $validator
            ->requirePresence('destino', 'create')
            ->notEmpty('destino');

        $validator
            ->allowEmpty('icono');

        $validator
            ->allowEmpty('etiqueta');

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
        $rules->add($rules->existsIn(['co_menu_id'], 'CoMenus'));
        return $rules;
    }
}
