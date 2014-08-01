<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SpeciespropertiesTable extends Table {

    public function initialize(array $config) {
        $this->table('species_properties');

        $this->belongsTo('Species');
        $this->belongsTo('Propertytypes');
        
        $this->hasOne('MinProperties', ['className' => 'Properties', 'foreignKey' => 'min_property_id']);
        $this->hasOne('MaxProperties', ['className' => 'Properties', 'foreignKey' => 'max_property_id']);
        

        $this->addBehavior('Timestamp');
    }

}
