<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller {

    public $components = [
        'Flash',
        'Auth' => [
            'loginRedirect' => [
                'contoller' => 'Species',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Pages',
                'action' => 'display',
                'home'
            ],
            'authorize' => ['Controller']
        ]
    ];

    public function beforeFilter(Event $event) {
        $this->Auth->allow('index', 'view');
    }
    
    public function isAuthorized($user)
    {
        // Allow access to everything for admins
        if(isset($user['role']) && $user['role'] === 'admin'){
            return true;
        }
        
        // Default action is to deny access
        return false;
    }

}
