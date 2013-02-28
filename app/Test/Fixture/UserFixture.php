<?php

class UserFixture extends CakeTestFixture {

    public $import = 'User';
    public $records = array(
        array(
            'id' => 1,
            'username' =>
            'First Admin',
            'password' => '',
            'role' => 'admin',
            'is_active' => 1,
            'oauth_provider' => 'google',
            'oauth_id' => 'id1',
            'oauth_token' => 'token1',
            'email' => 'user1@users.com',
            'created' => '2007-03-18 10:39:23', 'modified' => '2007-03-18 10:41:31'),
        
        array('id' => 2, 
            'username' => 'Second User', 
            'password' => '', 
            'role' => 'user', 
            'is_active' => 1, 
            'oauth_provider' => 'google',
            'oauth_id' => 'id2',
            'oauth_token' => 'token2',
            'email' => 'user2@users.com', 
            'created' => '2007-03-18 10:39:23', 'modified' => '2007-03-18 10:41:31'),
        
        array('id' => 3, 
            'username' => 'Third User', 
            'password' => '', 
            'role' => 'user', 
            'is_active' => 1, 
            'oauth_provider' => 'google',
            'oauth_id' => 'id3',
            'oauth_token' => 'token3',
            'email' => 'user3@users.com', 
            'created' => '2007-03-18 10:39:23', 'modified' => '2007-03-18 10:41:31'),
    );

}