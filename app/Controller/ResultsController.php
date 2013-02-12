<?php

class ResultsController extends AppController {
	
	public $components = array('Session');
	public $uses = array('Result', 'Test', 'Unit', 'TestSet');

	public function isAuthorized($user) {
		// All users can add results
		if ($this->action == 'add') {
			return true;
		}

		// Can only edit own results
		if (in_array($this->action, array('edit', 'delete'))) {
			$resultId = $this->request->params['pass'][0];
			if ($this->Result->isOwnedBy($resultId, $user['id'])) {
				return true;
			}
		}

		return parent::isAuthorized($user);
	}

	public function index() {
		$this->set('results', $this->Result->find('all'));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->request->data['Result']['user_id'] = $this->Auth->user('id');
			if ($this->Result->save($this->request->data)) {
				$this->Session->setFlash(__('The result has been saved'), 'alert', array('class' => 'alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Unable to add your result'), 'alert', array('class' => 'alert-error'));
			}
		}

		$tests = $this->Test->find('list');
		$testsets = $this->TestSet->find('list');
		$units = $this->Unit->find('list');
		$this->set(compact('tests', 'units', 'testsets'));
	}

	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Result->delete($id)) {
			$this->Session->setFlash(__('The result has been deleted'), 'alert', array('class' => 'alert-success'));
			$this->redirect(array('action' => 'index'));
		}
	}
}