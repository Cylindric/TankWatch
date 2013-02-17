<?php

class TanksController extends AppController {

    public function isAuthorized($user) {
        // All users can list their tanks, or add a new Tank
        if (in_array($this->action, array('add', 'index'))) {
            return true;
        }

        // Users can only edit their own Tanks
        if (in_array($this->action, array('delete', 'edit', 'view'))) {
            $id = $this->request->params['pass'][0];
            if ($this->Tank->isOwnedBy($id, $user['id'])) {
                return true;
            } else {
                throw new ForbiddenException(__('Access to this Tank is restricted'));
            }
        }

        return parent::isAuthorized($user);
    }

    public function index() {
        $this->set('tanks', $this->Tank->find('all'));
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid Tank'));
        }

        $this->Tank->id = $id;
        if (!$this->Tank->exists()) {
            throw new NotFoundException(__('Invalid Tank'));
        }
        
        $tank = $this->Tank->findById($id);
        $this->set(compact('tank'));
    }
    
    public function edit($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid Tank'));
        }

        $tank = $this->Tank->findById($id);
        if (!$tank) {
            throw new NotFoundException(__('Invalid Tank'));
        }

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Tank->id = $id;
			if ($this->Tank->save($this->request->data)) {
	 			$this->Session->setFlash(__('The Tank has been updated'), 'alert', array('class' => 'alert-success'));
	 			$this->redirect(array('action' => 'index'));
	 		} else {
	 			$this->Session->setFlash(__('Unable to update your Tank'), 'alert', array('class' => 'alert-error'));				
			}
		}

	    if (!$this->request->data) {
	        $this->request->data = $tank;
	    }
    }
    
    public function add() {
        // if ($this->request->is('post')) {
        // 	$this->request->data['Result']['user_id'] = $this->Auth->user('id');
        // 	if ($this->Result->save($this->request->data)) {
        // 		$this->Session->setFlash(__('The result has been saved'), 'alert', array('class' => 'alert-success'));
        // 		$this->redirect(array('action' => 'index'));
        // 	} else {
        // 		$this->Session->setFlash(__('Unable to add your result'), 'alert', array('class' => 'alert-error'));
        // 	}
        // }
        // $tests = $this->Test->find('list');
        // $testsets = $this->TestSet->find('list');
        // $units = $this->Unit->find('list');
        // $this->set(compact('tests', 'units', 'testsets'));
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Tank->delete($id)) {
            $this->Session->setFlash(__('The tank has been deleted'), 'alert', array('class' => 'alert-success'));
            $this->redirect(array('action' => 'index'));
        }
    }

}