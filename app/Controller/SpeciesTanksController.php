<?php

class SpeciesTanksController extends AppController {

    public $uses = array('SpeciesTank', 'Tank');

    public function isAuthorized($user) {
        if (in_array($this->action, array('index'))) {
            return true;
        }

        if (in_array($this->action, array('add'))) {
            $tank_id = $this->request->params['pass'][0];
            if ($this->Tank->isOwnedBy($tank_id, $user['id'])) {
                return true;
            }
        }

        if (in_array($this->action, array('delete', 'edit'))) {
            $id = $this->request->params['pass'][0];
            if ($this->SpeciesTank->isOwnedBy($id, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function add($tank_id) {
        if (!$this->Tank->exists($tank_id)) {
            throw new NotFoundException(__('That Tank does not exist'));
        }

        if ($this->request->is('post')) {
            if ($this->SpeciesTank->save($this->request->data)) {
                $this->Session->setFlash(__('The species has been added to the tank'), 'alert', array('class' => 'alert-success'));
                $this->redirect(array('controller' => 'tanks', 'action' => 'view', $tank_id));
            } else {
                $this->Session->setFlash(__('Unable to add your species to the tank'), 'alert', array('class' => 'alert-error'));
            }
        }

        if (empty($this->request->data)) {
            $this->request->data = $this->SpeciesTank->create();
            $this->request->data['SpeciesTank']['tank_id'] = $tank_id;
        }
    }

}