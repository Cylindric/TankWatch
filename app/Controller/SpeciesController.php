<?php

class SpeciesController extends AppController {

    public function beforeFilter() {
        
    }

    public function isAuthorized($user) {
        // Users can view
        if (in_array($this->action, array('typeahead', 'index'))) {
            return true;
        }

        return parent::isAuthorized($user);
    }

    public function admin_index() {
        $species = $this->Species->find('all');
        $this->set(compact('species'));
    }

    public function admin_edit($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid Species'));
        }

        $species = $this->Species->findById($id);
        if (!$species) {
            throw new NotFoundException(__('Invalid Species'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Species->id = $id;
            if ($this->Species->save($this->request->data)) {
                $this->Session->setFlash(__('The Species has been updated'), 'notify', array('class' => 'success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Unable to update your Species'), 'notify', array('class' => 'error'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $species;
        }
    }

    public function admin_add() {
        if ($this->request->is('post')) {
            $this->request->data['Species']['user_id'] = $this->Auth->user('id');
            if ($this->Species->save($this->request->data)) {
                $this->Session->setFlash(__('The species has been added'), 'notify', array('class' => 'success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Unable to add your species'), 'notify', array('class' => 'error'));
            }
        }
    }

    public function index() {
        $species = $this->Species->find('all');
        $this->set(compact('species'));
    }

    public function view($id) {
        $species = $this->Species->findById($id);
        $this->set(compact('species'));
    }

    public function typeahead() {
        $query = '';
        if (array_key_exists('q', $this->request->query)) {
            $query = $this->request->query['q'];
        }
        $species = $this->Species->find('all', array(
            'contain' => array(),
            'fields' => array('id', 'name'),
            'conditions' => array(
                'name LIKE' => '%' . $query . '%'
                ))
        );

        $data = array();
        foreach ($species as $s) {
            $data[] = $s['Species'];
        }

        $this->set('species', $data);
        $this->set('_serialize', array('species'));
    }

}