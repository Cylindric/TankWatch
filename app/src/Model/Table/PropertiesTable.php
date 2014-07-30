<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PropertiesTable extends Table {

    public function initialize(array $config) {
        $this->belongsTo('SpeciesProperties');
        $this->hasOne('Propertytypes');

        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator) {
        $validator->notEmpty('value');
        return $validator;
    }

}
