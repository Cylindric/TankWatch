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
        if (!$this->Species->exists($this->data['SpeciesTank']['species_id'])) {
            $this->invalidate('species_id', 'Specified Species does not exist');
        }
        if (!$this->Tank->exists($this->data['SpeciesTank']['tank_id'])) {
            $this->invalidate('tank_id', 'Specified Tank does not exist');
        }
    }
}