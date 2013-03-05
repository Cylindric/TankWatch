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
                'rule' => array('inList', array('admin', 'user', 'registered')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );

    public function beforeSave($options = array()) {

        if (isset($this->data[$this->alias]['password'])) {

            if (isset($this->data[$this->alias]['old_password'])) {
                // Check that the supplied old password matches what's in the db
                $current_password = $this->field('password', array('id' => AuthComponent::user('id')));
                $supplied_password = AuthComponent::password($this->data[$this->alias]['old_password']);
                if ($current_password !== $supplied_password) {
                    $this->invalidate('old_password', 'incorrect password');
                    return false;
                }
            }

            // Make sure both new passwords are the same
            if (isset($this->data[$this->alias]['confirm_password'])) {
                if ($this->data[$this->alias]['password'] !== $this->data[$this->alias]['confirm_password']) {
                    $this->invalidate('confirm_password', 'passwords do not match');
                    return false;
                }
            }

            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        if (!isset($this->data[$this->alias]['role'])) {
            $this->data[$this->alias]['role'] = 'user';
        }

        return true;
    }

    /**
     * Determine wether or not the specified user is owned by the specified user
     * @param int $model_id The id of the record to check
     * @param int $user_id The id of the user to verify
     * @return bool
     */
    public function isOwnedBy($model_id, $user_id) {
        return $this->field('id', array('id' => $model_id, 'id' => $user_id)) == $model_id;
    }

    public function getAuthenticationCookieData() {
        if (empty($this->id)) {
            throw new InvalidArgumentException(__('No user specified'));
        }

        $this->read();
        $cookie_data = array('User' => array(
                'id' => $this->data['User']['id'],
                'password' => $this->data['User']['password'],
                ));
        return $cookie_data;
    }

    public function findByTokenIdentifier($oauth_provider, $oauth_id) {
        return $this->find('first', array(
                    'conditions' => array(
                        'oauth_provider' => $oauth_provider,
                        'oauth_id' => $oauth_id,
                    ),
                ));
    }

}