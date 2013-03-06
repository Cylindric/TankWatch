<?php

class SpeciesTank extends AppModel {

    public $belongsTo = array('Species', 'Tank');
    public $validate = array(
        'species_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
            ),
        ),
        'tank_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
            ),
        ),
        'quantity' => array(
            'required' => array(
                'rule' => array('notEmpty'),
            ),
        ),
    );

    public function isOwnedBy($model_id, $user_id) {
        $tank_id = (int) $this->field('tank_id', array('id' => $model_id));
        return $result = $this->Tank->isOwnedBy($tank_id, $user_id);
    }

    public function beforeValidate($options = array()) {
        if (!$this->Tank->exists($this->data['SpeciesTank']['tank_id'])) {
            $this->invalidate('tank_id', 'Specified Tank does not exist');
        }
    }

    /**
     * If a Species is specified by name instead of Id, make sure that Species
     * exists. If it doesn't, create it.
     * @param type $options
     * @return boolean
     */
    public function beforeSave($options = array()) {
        if (array_key_exists('species_name', $this->data['SpeciesTank'])) {
            $species = $this->Species->findByName($this->data['SpeciesTank']['species_name']);
            if (empty($species)) {
                $new_species = $this->Species->create();
                $new_species['name'] = $this->data['SpeciesTank']['species_name'];
                if ($this->Species->save($new_species)) {
                    CakeLog::info(sprintf('new species %s created by user %s', $new_species['name'], AuthComponent::user('username')));
                } else {
                    return false;
                }
                $this->data['SpeciesTank']['species_id'] = $this->Species->id;
            } else {
                $this->data['SpeciesTank']['species_id'] = $species['Species']['id'];
            }
        }
        return true;
    }

}