<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CoPermissionsTable extends Table
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

        $this->table('co_permissions');
        $this->displayField('name');
        $this->primaryKey('co_permission_id');

           $this->addBehavior('Timestamp');
        
        $this->belongsToMany('CoGroups', [
            'joinTable' => 'co_groups_permissions',
        ]);
        
        

        
       
    }
    
     public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('co_permission_id')
            ->allowEmpty('co_permission_id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

      

        return $validator;
    }
    

}
  
?>
