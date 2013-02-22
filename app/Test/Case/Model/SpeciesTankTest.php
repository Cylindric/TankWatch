<?php

App::uses('SpeciesTank', 'Model');

class SpeciesTankTest extends CakeTestCase {

    public $fixtures = array('app.species_tank', 'app.tank', 'app.species');

    public function setUp() {
        parent::setUp();
        $this->SpeciesTank = ClassRegistry::init('SpeciesTank');
    }

    public function testSpeciesIsRequired() {
        $new = array('species_id' => null, 'tank_id' => 1, 'quantity' => 123);
        $this->SpeciesTank->set($new);
        $result = $this->SpeciesTank->validates();
        $this->assertFalse($result, 'Attempt to insert null Species succeeded');
    }

    public function testSpeciesExists() {
        $new = array('species_id' => 666, 'tank_id' => 1, 'quantity' => 123);
        $this->SpeciesTank->set($new);
        $result = $this->SpeciesTank->validates();
        $this->assertFalse($result, 'Attempt to insert invalid Species succeeded');
    }

    public function testTankExists() {
        $new = array('species_id' => 1, 'tank_id' => 666, 'quantity' => 123);
        $this->SpeciesTank->set($new);
        $result = $this->SpeciesTank->validates();
        $this->assertFalse($result, 'Attempt to insert invalid Tank succeeded');
    }

    public function testTankIsRequired() {
        $new = array('species_id' => 1, 'tank_id' => null, 'quantity' => 123);
        $this->SpeciesTank->set($new);
        $result = $this->SpeciesTank->validates();
        $this->assertFalse($result, 'Attempt to insert null Tank succeeded');
    }

    public function testQuantityIsRequired() {
        $new = array('species_id' => 1, 'tank_id' => null, 'quantity' => 123);
        $this->SpeciesTank->set($new);
        $result = $this->SpeciesTank->validates();
        $this->assertFalse($result, 'Attempt to insert null Quantity succeeded');
    }

    public function testIsOwnedByAllowsOwner() {
        $s = CakeSession::read('Auth.User.role');
        CakeSession::write('Auth.User.role', 'admin');
        $result = $this->SpeciesTank->isOwnedBy(1, 1);
        $this->assertTrue($result, 'Tank 1 owned by 1 cannot be seen by user 1');
        CakeSession::write('Auth.User.role', $s);
    }

    public function testIsOwnedByDeniesOther() {
        $s = CakeSession::read('Auth.User.role');
        CakeSession::write('Auth.User.role', 'admin');
        $result = $this->SpeciesTank->isOwnedBy(1, 2);
        $this->assertFalse($result, 'Tank 1 owned by 1 can be seen by user 2');
        CakeSession::write('Auth.User.role', $s);
    }

    public function testAddSpeciesToTank() {
        $data = array('species_id' => 1, 'tank_id' => 1, 'quantity' => 3);
        $result = $this->SpeciesTank->save($data);
        $this->assertEquals($data['species_id'], $result['SpeciesTank']['species_id']);
        $this->assertEquals($data['tank_id'], $result['SpeciesTank']['tank_id']);
        $this->assertEquals($data['quantity'], $result['SpeciesTank']['quantity']);
    }

    public function testAddSpeciesToTankDeep() {
        $data = array('SpeciesTank' => array('species_id' => 1, 'tank_id' => 1, 'quantity' => 3));
        $result = $this->SpeciesTank->save($data);
        $this->assertEquals($data['SpeciesTank']['species_id'], $result['SpeciesTank']['species_id']);
        $this->assertEquals($data['SpeciesTank']['tank_id'], $result['SpeciesTank']['tank_id']);
        $this->assertEquals($data['SpeciesTank']['quantity'], $result['SpeciesTank']['quantity']);
    }

}