<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {

	public $components = array(
		'Session',
		'Auth' => array(
			'loginRedirect' => array('controller' => 'results', 'action' => 'index'),
			'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
			'authorize' => array('Controller')
		),
		'DebugKit.Toolbar'
	);

    public $helpers = array(
        'Session',
    );

    public function isAuthorized($user) {
    	if (isset($user['role']) && $user['role'] === 'admin') {
    		return true;
    	}

        if (isset($user['role']) && $user['role'] === 'user') {
            if (in_array($this->action, array('index'))) {
                return true;
            }
        }

    	return false;
    }
}
