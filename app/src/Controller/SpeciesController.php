<?php

namespace App\Controller;

class SpeciesController extends AppController {

    public $components = ['Csrf', 'Flash'];

    public function isAuthorized($user){
        // Anyone can view species
        if($this->request->action === 'index'){
            return true;
        }
        
        return parent::isAuthorized($user);
    }
    
    public function index() {
        $species = $this->Species->find('all');
        $this->set(compact('species'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException('Invalid Species.');
        }

        $species = $this->Species->get($id);
        $this->set(compact('species'));
    }

    public function add() {
        $species = $this->Species->newEntity($this->request->data);
        if ($this->request->is('post')) {
            if ($this->Species->save($species)) {
                $this->Flash->success('Your species has been saved.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Unable to add your species.');
        }
        $this->set('species', $species);
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException('Invalid species.');
        }

        $species = $this->Species->get($id);

        if ($this->request->is(['post', 'put'])) {
            $this->Species->patchEntity($species, $this->request->data);
            if ($this->Species->save($species)) {
                $this->Flash->success('Your species has been updated.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Unable to update your species.');
        }
        $this->set('species', $species);
    }

    public function delete($id) {
        $this->request->allowMethod(['post', 'delete']);

        $species = $this->Species->get($id);
        if ($this->Species->delete($species)) {
            $this->Flash->success(__('The species with id: %s has been deleted.', h($id)));
            return $this->redirect(['action' => 'index']);
        }
    }

}
