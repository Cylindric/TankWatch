<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SpeciespropertiesTable extends Table {

    public function initialize(array $config) {
        $this->table('species_properties');

        $this->belongsTo('Species');
        $this->belongsTo('MinProperties', ['className' => 'Properties', 'foreignKey' => 'min_property_id']);
        $this->belongsTo('MaxProperties', ['className' => 'Properties', 'foreignKey' => 'max_property_id']);
        $this->belongsTo('Propertytypes');

        $this->addBehavior('Timestamp');
    }

}
