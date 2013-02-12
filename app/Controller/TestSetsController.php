<?php

class TestSetsController extends AppController {
	
	public $uses = array('Test', 'TestSet', 'Result');

	public function isAuthorized($user) {
		// All users can add results
		if ($this->action == 'add') {
			return true;
		}

		// Can only edit own results
		if (in_array($this->action, array('edit', 'delete', 'view'))) {
			$testSetId = $this->request->params['pass'][0];
			if ($this->TestSet->isOwnedBy($testSetId, $user['id'])) {
				return true;
			}
		}

		return parent::isAuthorized($user);
	}

	public function index() {
		$this->set('testsets', $this->TestSet->find('all'));
	}

	public function add() {
	 	if ($this->request->is('post')) {
	 		debugger::dump($this->request->data);
	 		$this->request->data['TestSet']['user_id'] = $this->Auth->user('id');
			if ($this->TestSet->save($this->request->data)) {
	 			$this->Session->setFlash(__('The test set has been saved'), 'alert', array('class' => 'alert-success'));
	 			$this->redirect(array('action' => 'index'));
	 		} else {
	 			$this->Session->setFlash(__('Unable to add your test set'), 'alert', array('class' => 'alert-error'));
	 		}
		}

	 	$tests = $this->Test->find('list');
	 	$this->set(compact('tests'));
	}

	public function view($id) {
		if (!$id) {
			throw new NotFoundException(__('Invalid Test Set'));
		}

		$testset = $this->TestSet->findById($id);
		if (!$testset) {
			throw new NotFoundException(__('Invalid Test Set'));			
		}

		$results = $this->Result->getResultsForTestSet($testset);
		$this->set(compact('testset', 'results'));
	}

	public function edit($id) {
		if (!$id) {
			throw new NotFoundException(__('Invalid Test Set'));
		}

		$testset = $this->TestSet->findById($id);
		if (!$testset) {
			throw new NotFoundException(__('Invalid Test Set'));			
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->TestSet->id = $id;
			if ($this->TestSet->save($this->request->data)) {
	 			$this->Session->setFlash(__('The test set has been updated'), 'alert', array('class' => 'alert-success'));
	 			$this->redirect(array('action' => 'index'));
	 		} else {
	 			$this->Session->setFlash(__('Unable to update your test set'), 'alert', array('class' => 'alert-error'));				
			}
		}

	 	$tests = $this->Test->find('list', array(
	 		'fields' => array('Test.id', 'Test.display_name'),
	 		'order' => 'Test.name'
	 	));

	 	$this->set(compact('tests'));

	    if (!$this->request->data) {
	        $this->request->data = $testset;
	    }
   	}
	// public function delete($id) {
	// 	if ($this->request->is('get')) {
	// 		throw new MethodNotAllowedException();
	// 	}

	// 	if ($this->Result->delete($id)) {
	// 		$this->Session->setFlash(__('The result has been deleted'), 'alert', array('class' => 'alert-success'));
	// 		$this->redirect(array('action' => 'index'));
	// 	}
	// }
}