<?php

namespace App\Controller;

use Cake\Event\Event;

class UsersController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Auth->allow(['logout']);
    }

    public function login() {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Invalid username or password, please try again.');
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

}
