<?php

class UserFixture extends CakeTestFixture {

    public $import = 'User';
    public $records = array(
        array('id' => 1, 'username' => 'First Admin', 'password' => '', 'role' => 'admin', 'email' => 'user1@users.com', 'created' => '2007-03-18 10:39:23', 'modified' => '2007-03-18 10:41:31'),
        array('id' => 2, 'username' => 'Second User', 'password' => '', 'role' => 'user', 'email' => 'user2@users.com', 'created' => '2007-03-18 10:39:23', 'modified' => '2007-03-18 10:41:31'),
        array('id' => 3, 'username' => 'Third User', 'password' => '', 'role' => 'user', 'email' => 'user3@users.com', 'created' => '2007-03-18 10:39:23', 'modified' => '2007-03-18 10:41:31'),
    );

}