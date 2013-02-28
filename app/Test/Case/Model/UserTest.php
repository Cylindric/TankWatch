<?php

App::uses('User', 'Model');

class UserTest extends CakeTestCase {

    public $fixtures = array('app.user');

    public function setUp() {
        parent::setUp();
        $this->User = ClassRegistry::init('User');
    }

    public function testFindUserByTokenIdentifier() {
        $user = $this->User->findByTokenIdentifier('google', 'id1');
        $this->assertEquals(1, $user['User']['id']);
    }

    public function testFindUserByTokenIdentifierFails() {
        $user = $this->User->findByTokenIdentifier('google', 'a_nonexistent_token_id');
        $this->assertEmpty($user);
    }
    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetAuthenticationCookieDataFailsWithNoUser() {
        $this->User->create();
        $this->User->getAuthenticationCookieData();
    }

    public function testGetAuthenticationCookieDataCreatesCookie() {
        $this->User->id = 1;
        $data = $this->User->getAuthenticationCookieData();
        debug($data);
    }}