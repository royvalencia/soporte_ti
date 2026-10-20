<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;
use Cake\Auth\DefaultPasswordHasher;

class CoUsersTable extends Table
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

        $this->table('co_users');
        $this->displayField('clave_nombre');
        $this->primaryKey('co_user_id');

         $this->addBehavior('Timestamp');

        $this->belongsTo('CoGroups', [
            'foreignKey' => 'co_group_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Dependencias', [
            'foreignKey' => 'dependencia_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Direcciones', [
            'foreignKey' => 'direccione_id',
            'joinType' => 'INNER',
        ]);

    }

    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('login', 'A username is required')
            ->notEmpty('password', 'A password is required')
           ;
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
        //$rules->add($rules->isUnique(['email'],'El correo electrónico se encuentra en uso, utilice otro o recupere su contraseña.'));
        $rules->add($rules->isUnique(['login'],'El login se encuentra en uso, utilice otro o recupere su contraseña.'));

        return $rules;
    }

   /**
   * Validacion del cambio de contraseña
   *
   * @param Validator $validator
   * @return Validator
   */
    public function validationPassword(Validator $validator) {
        $validator->add('old_password', 'custom', [
            'rule' => function ($value, $context) {
                    $user = $this->get($context['data']['co_user_id']);
                    if ($user) {
                        if ((new DefaultPasswordHasher)->check($value, $user->password)) {
                            return true;
                        }
                    }
                    return false;
                }, 'message' => 'La contraseña anterior es incorrecta.', ])
                ->notEmpty('old_password');
       $validator->add('password1', [
            'length' => ['rule' => ['minLength', 6], 'message' => 'La contraseña debe ser de al menos 6 caracteres', ]])
                                    ->add('password1', ['match' => ['rule' => ['compareWith', 'password2'], 'message' => 'Las contraseñas no coinciden', ]])
                                    ->notEmpty('password1');
        $validator->add('password2', ['length' => ['rule' => ['minLength', 6], 'message' => 'La contraseña debe ser de al menos 6 caracteres', ]])
                                    ->add('password2', ['match' => ['rule' => ['compareWith', 'password1'], 'message' => 'Las contraseñas no coinciden', ]])
                                    ->notEmpty('password2');

       /* $validator
            ->add('password1', [
                'length' => ['rule' => ['minLength', 8], 'message' => 'La contraseña debe tener al menos 8 caracteres'],
                'strength' => ['rule' => 'validatePasswordStrength', 'message' => 'La contraseña debe ser fuerte (combinación de mayúsculas, minúsculas, números y caracteres especiales)'],
                'match' => ['rule' => ['compareWith', 'password2'], 'message' => 'Las contraseñas no coinciden'],
                'notEmpty' => ['rule' => 'notEmptyString', 'message' => 'La contraseña es requerida']
            ]);

        $validator
            ->add('password2', [
                'match' => ['rule' => ['compareWith', 'password1'], 'message' => 'Las contraseñas no coinciden'],
                'notEmpty' => ['rule' => 'notEmptyString', 'message' => 'La contraseña de confirmación es requerida']
            ]);*/


        return $validator;
    }
    public function validatePasswordStrength($value)
    {
        // Regla de validación más estricta, puedes personalizarla según tus necesidades
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $value);
    }

}

?>
