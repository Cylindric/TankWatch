<?php
App::uses('CakeSession', 'Model/Datasource');

class Result extends AppModel {
	public $belongsTo = array('Test', 'Unit', 'TestSet');

	public $validate = array(
		'value' => array('numeric' => array('rule' => 'numeric', 'required' => true, 'message' => 'You must enter a numeric value')),
	);

	public function isOwnedBy($result, $user) {
		return $this->field('id', array('id' => $result, 'user_id' => $user)) == $result;
	}

	public function beforeFind($querydata) {
		if (CakeSession::read('Auth.User.role') !== 'admin') {
			$uid = CakeSession::read("Auth.User.id");
			$querydata['conditions']['Result.user_id'] = $uid;
		}
		return $querydata;
	}

	public function getResultsForTestSet($testset) {
		$setid = $testset['TestSet']['id'];

		$results = $this->find('all', array(
			'contain' => array(
				'TestSet' => array('conditions' => array('TestSet.id' => $setid)),
				'Test'
			),
		));

		debugger::dump($results);
		return $results;
	}

}