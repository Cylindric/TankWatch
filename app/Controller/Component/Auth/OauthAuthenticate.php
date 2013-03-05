<?php

App::uses('BaseAuthenticate', 'Controller/Component/Auth');
App::uses('User', 'Model');

class OauthAuthenticate extends BaseAuthenticate {
    
    public function authenticate(CakeRequest $request, CakeResponse $response) {
        $this->User = ClassRegistry::init('User');
        if (array_key_exists('auth', $request->data)) {
        	$user = $this->User->findByTokenIdentifier($request->data['auth']['provider'], $request->data['auth']['uid']);
    	}
        if (empty($user)) {
            return false;
        } else {
            return $user['User'];
        }

    }

}