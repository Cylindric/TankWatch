<?php

App::uses('Model', 'Model');

class AppModel extends Model {

    public $actsAs = array('Containable');

    /**
     * Determine wether or not the specified record is owned by the specified user
     * @param int $model_id The id of the record to check
     * @param int $user_id The id of the user to verify
     * @return bool
     */
    public function isOwnedBy($model_id, $user_id) {
        return $this->field('id', array('id' => $model_id, 'user_id' => $user_id)) == $model_id;
    }

}
