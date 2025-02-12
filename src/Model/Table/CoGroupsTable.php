<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CoGroupsTable extends Table
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

        $this->table('co_groups');
        $this->displayField('name');
        $this->primaryKey('co_group_id');

         $this->hasMany('CoUsers', [
            'foreignKey' => 'co_group_id'
        ]);
        /*$this->hasMany('Grupos', [
            'foreignKey' => 'grupo_id'
        ]);*/
        //En las relaciones N:M la tabla pivote debe contar con una clave primaria, si no en cake 3 no jala
        $this->belongsToMany('CoPermissions', [
            'joinTable' => 'co_groups_permissions',
        ]);
        
       $this->belongsToMany('CoMenus', [
            'joinTable' => 'co_groups_menus',
            'foreignKey'=>'co_group_id'    ,
            'targetForeignKey'=>'co_menu_id'
        ]);

           $this->addBehavior('Timestamp');        
       
    }
    
     public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('co_group_id')
            ->allowEmpty('co_group_id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

      

        return $validator;
    }
    

}
  
?>
