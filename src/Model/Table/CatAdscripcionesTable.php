<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CatAdscripciones Model
 *
 * @property \App\Model\Table\CatInstitucionesTable|\Cake\ORM\Association\BelongsTo $CatInstituciones
 *
 * @method \App\Model\Entity\CatAdscripcione get($primaryKey, $options = [])
 * @method \App\Model\Entity\CatAdscripcione newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CatAdscripcione[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CatAdscripcione|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CatAdscripcione patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CatAdscripcione[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CatAdscripcione findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CatAdscripcionesTable extends Table
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

        $this->setTable('cat_adscripciones');
        $this->setDisplayField('nom_ads');
        $this->setPrimaryKey('cat_adscripcione_id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CatInstituciones', [
            'foreignKey' => 'cat_institucione_id',
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
            ->integer('cat_adscripcione_id')
            ->allowEmpty('cat_adscripcione_id', 'create');

        $validator
            ->scalar('cve_ads')
            ->maxLength('cve_ads', 50)
            ->requirePresence('cve_ads', 'create')
            ->notEmpty('cve_ads');

        $validator
            ->scalar('nom_ads')
            ->maxLength('nom_ads', 250)
            ->requirePresence('nom_ads', 'create')
            ->notEmpty('nom_ads');

        $validator
            ->integer('cveusuad')
            ->requirePresence('cveusuad', 'create')
            ->notEmpty('cveusuad');

        $validator
            ->integer('cveucoad')
            ->requirePresence('cveucoad', 'create')
            ->notEmpty('cveucoad');

        $validator
            ->boolean('estatus')
            ->requirePresence('estatus', 'create')
            ->notEmpty('estatus');

        $validator
            ->date('vigencia_inicial')
            ->allowEmpty('vigencia_inicial');

        $validator
            ->date('vigencia_final')
            ->allowEmpty('vigencia_final');

        $validator
            ->scalar('anio')
            ->allowEmpty('anio');

        $validator
            ->scalar('num_plaza_titular')
            ->maxLength('num_plaza_titular', 11)
            ->requirePresence('num_plaza_titular', 'create')
            ->notEmpty('num_plaza_titular');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['cat_institucione_id'], 'CatInstituciones'));

        return $rules;
    }*/

        /**
     * Returns the database connection name to use by default.
     *
     * @return string
     */
    /*public static function defaultConnectionName()
    {
        return 'sideol';
    }*/

}
