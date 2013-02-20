<?php

class TanksController extends AppController {

    public $uses = array('Tank', 'SpeciesTank');
    
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

        $this->Tank->contain(array('SpeciesTank', 'SpeciesTank.Species'));
        $tank = $this->Tank->findById($id);
        
        $inhabitants = $this->SpeciesTank->find('all', array(
            'contain' => array('Species' => array('fields' => array('id', 'name'))),
            'fields' => array('species_id', 'SUM(quantity) AS quantity'),
            'group' => array('species_id HAVING SUM(quantity) > 0'),
            'order' => array('Species.name'),
            
        ));
        
        $this->set(compact('tank', 'inhabitants'));
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
        if ($this->request->is('post')) {
            $this->request->data['Tank']['user_id'] = $this->Auth->user('id');
            if ($this->Tank->save($this->request->data)) {
                $this->Session->setFlash(__('The tank has been added'), 'alert', array('class' => 'alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Unable to add your tank'), 'alert', array('class' => 'alert-error'));
            }
        }
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