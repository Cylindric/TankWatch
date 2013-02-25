<?php

require_once(APP . 'Vendor' . DS . 'google-api-php-client' . DS . 'src' . DS . 'Google_Client.php');

class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('login', 'logout', 'register', 'oauth2callback'));
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

    public function register() {
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
        } else {
            $client = new Google_Client();
            $client->setApplicationName('TankWatch');
            $client->setClientId(Configure::read('OAuth.Google.ClientID'));
            $client->setClientSecret(Configure::read('OAuth.Google.ClientSecret'));
            $client->setRedirectUri(Configure::read('OAuth.Google.RedirectUri'));
            $client->setDeveloperKey(Configure::read('OAuth.Google.DeveloperKey'));
            $client->setScopes('https://www.googleapis.com/auth/userinfo.email');

            $authUrl = $client->createAuthUrl();

            $this->set(array('GoogleAuthUrl' => $authUrl));
        }
    }

    public function oauth2callback() {
        if ($client->getAccessToken()) {
            $user = $oauth2->userinfo->get();

            debug($user);

            // The access token may have been updated lazily.
            $token = $client->getAccessToken();
            debug($token);
        }
    }

    public function logout() {
        $this->Session->setFlash(__('Logged out'));
        $this->redirect($this->Auth->logout());
    }

}