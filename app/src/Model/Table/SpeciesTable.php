<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class SpeciesTable extends Table {

    public function initialize(array $config) {
        $this->hasMany('Speciesproperties');
        
        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator) {
        $validator->notEmpty('name');
        return $validator;
    }

}
