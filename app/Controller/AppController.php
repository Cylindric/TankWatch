<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {

	public $components = array(
		'Session',
		'Auth' => array(
			'loginRedirect' => array('controller' => 'tanks', 'action' => 'index'),
			'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
			'authorize' => array('Controller')
		),
		//'DebugKit.Toolbar'
	);

    public $helpers = array(
        'Session',
    );

    public function isAuthorized($user) {
    	if (isset($user['role']) && $user['role'] === 'admin') {
    		return true;
    	}

    	// All users can access the index page by default.
    	if (isset($user['role']) && $user['role'] === 'user' && $this->action === 'index') {
    		return true;
    	}

    	return false;
    }
}
