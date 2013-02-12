<?php
App::uses('CakeSession', 'Model/Datasource');

class TestSet extends AppModel {
	public $hasAndBelongsToMany = array('Test');

	public $validate = array(
		'name' => array('notEmpty' => array('rule' => 'notEmpty', 'required' => true, 'message' => 'You must enter a name')),
	);

	public function isOwnedBy($testset, $user) {
		return $this->field('id', array('id' => $testset, 'user_id' => $user)) == $testset;
	}

	public function beforeFind($querydata) {
		if (CakeSession::read('Auth.User.role') !== 'admin') {
			$uid = CakeSession::read("Auth.User.id");
			$querydata['conditions']['TestSet.user_id'] = $uid;
		}
		return $querydata;
	}

}