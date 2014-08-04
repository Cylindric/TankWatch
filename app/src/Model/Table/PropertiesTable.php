<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PropertiesTable extends Table {

    public function initialize(array $config) {
        $this->belongsTo('Species');
        $this->belongsTo('Propertytypes');

        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator) {
        $validator->notEmpty('value');
        return $validator;
    }

}
