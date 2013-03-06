<?php

class TanksController extends AppController {

    public $uses = array('Tank', 'SpeciesTank');

    public function isAuthorized($user) {
        if (in_array($this->action, array('add', 'index'))) {
            return true;
        }

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
            'conditions' => array('tank_id' => $id),
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
                $this->Session->setFlash(__('The Tank has been updated'), 'notify', array('class' => 'success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Unable to update your Tank'), 'notify', array('class' => 'error'));
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
                $this->Session->setFlash(__('The tank has been added'), 'notify', array('class' => 'success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Unable to add your tank'), 'notify', array('class' => 'error'));
            }
        }
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Tank->delete($id)) {
            $this->Session->setFlash(__('The tank has been deleted'), 'notify', array('class' => 'success'));
            $this->redirect(array('action' => 'index'));
        }
    }

}