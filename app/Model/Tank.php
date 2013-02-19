<?php

class Tank extends AppModel {

    public $belongsTo = array('User');
    public $hasMany = array('SpeciesTransactions');

    /**
     * Ensure that users can only see their own objects
     * @param array $querydata
     * @return array
     */
    public function beforeFind($querydata) {
        if (CakeSession::read('Auth.User.role') !== 'admin') {
            $uid = CakeSession::read("Auth.User.id");
            $querydata['conditions']['Tank.user_id'] = $uid;
        }
        return $querydata;
    }

}