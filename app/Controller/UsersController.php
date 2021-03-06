<?php

class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('opauth_complete', 'login', 'logout', 'register'));
    }

    public function isAuthorized($user) {
        if (in_array($this->action, array('add', 'index'))) {
            return true;
        }

        if ($this->action == 'edit') {
            if (empty($this->request->params['pass'])) {
                $id = AuthComponent::user('id');
            } else {
                $id = $this->request->params['pass'][0];
            }
            CakeLog::debug(sprintf('User %s accessing the %s action with parameter %s', $user['id'], $this->action, $id));
            if ($this->User->isOwnedBy($id, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function register($new_user = null) {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Registration complete!'));
                if ($this->Auth->login()) {
                    return $this->redirect($this->Auth->redirectUrl());
                }
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('There was a problem with your registration. Please, try again.'));
            }
        }
    }

    public function edit($id = null) {
        if (empty($id)) {
            $id = AuthComponent::user('id');
        }
        $this->User->id = $id;

        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            // if the new password and confirm are empty, unset everything so they stay the same as they are currently
            if (empty($this->request->data['User']['password']) && empty($this->request->data['User']['confirm_password'])) {
                unset($this->request->data['User']['old_password']);
                unset($this->request->data['User']['password']);
                unset($this->request->data['User']['confirm_password']);
            }

            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'edit'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid username or password, please try again'));
            }
        }
    }

    public function opauth_complete() {
        if (!$this->request->is('post')) {
            throw new NotFoundException();
        }

        if (!array_key_exists('auth', $this->data)) {
            // OAuth login failed, as there is no 'auth' information available. Try again.
            CakeLog::info('Opauth failed');
            debug($this->data);
            $this->Session->setFlash(__('Invalid username or password, please try again'));
            //$this->redirect($this->Auth->redirectUrl());
        }

        if ($this->Auth->login()) {
            // OAuth succeeded, and the user was found.
            $this->redirect($this->Auth->redirect());
        } else {
            // OAuth succeeded, but the user was not found, so add them and head over to edit.
            CakeLog::info('Creating new user from OAuth');
            $new_user = $this->User->create();
            $new_user['User']['username'] = $this->data['auth']['info']['email'];
            $new_user['User']['name'] = $this->data['auth']['info']['name'];
            $new_user['User']['role'] = 'registered';
            $new_user['User']['email'] = $this->data['auth']['info']['email'];
            $new_user['User']['oauth_id'] = $this->data['auth']['uid'];
            $new_user['User']['oauth_token'] = $this->data['auth']['credentials']['token'];
            $new_user['User']['oauth_expires'] = $this->data['auth']['credentials']['expires'];
            $new_user['User']['oauth_created'] = $this->data['timestamp'];
            $new_user['User']['oauth_provider'] = $this->data['auth']['provider'];
            $new_user['User']['password'] = substr(md5(rand()), 0, 24);
            $this->User->create();
            if ($this->User->save($new_user)) {
                $this->Session->setFlash(__('Registration complete!'));
                if ($this->Auth->login()) {
                    return $this->redirect(array('action' => 'edit', $this->User->id));
                }
            } else {
                $this->Session->setFlash(__('There was a problem with your registration. Please, try again. '));
                debug($this->User->validationErrors);
                //$this->redirect($this->Auth->redirectUrl());
            }

            //$this->redirect($this->Auth->redirectUrl());
        }
    }

    public function logout() {
        $this->Session->setFlash(__('Logged out'));
        $this->redirect($this->Auth->logout());
    }

}