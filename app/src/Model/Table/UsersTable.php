<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table {

    public function initialize(array $config) {
        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator) {
        return $validator
                        ->notEmpty('username', 'A username is required')
                        ->notEmpty('password', 'A password is required')
                        ->notEmpty('role', 'A role is required')
                        ->add('role', 'inList', [
                            'rule' => ['inList', ['admin', 'user']],
                            'message' => 'Please enter a valid role'
        ]);
    }

}
