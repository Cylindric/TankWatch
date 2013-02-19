<?php
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
	
	public $validate = array(
		'username' => array(
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'This username is already taken',
                'last' => false,
			),
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A username is required'
			)
		),
		'password' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A password is required'
			)
		),
		'email' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'An email address is required',
                'last' => false,
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'This email address is already registered',
                'last' => false,
			),
            'email' => array(
                'rule' => array('email'),
                'message' => 'Must be a valid email address',
                'last' => false,
            ),
		),
		'role' => array(
			'valid' => array(
				'rule' => array('inList', array('admin', 'user')),
				'message' => 'Please enter a valid role',
				'allowEmpty' => false
			)
		)
	);

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		if (!isset($this->data[$this->alias]['role'])) {
			$this->data[$this->alias]['role'] = 'user';
		}
		return true;
	}

}