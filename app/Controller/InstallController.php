<?php

class InstallController extends AppController {
	
	public $uses = array('Result', 'Species', 'SpeciesTransaction', 'Tank', 'Test', 'User', 'Unit', 'TestSet');

	public function isAuthorized($user) {
        return true;
//		return parent::isAuthorized($user);
	}

	public function index() {

    }
	
    public function install() {
        // Add an admin user
		$user = $this->User->findByUsername('admin');
		if (empty($user)) {
			$user = $this->User->create();
			$user['User']['username'] = 'admin';
			$user['User']['password'] = 'admin';
			$user['User']['role'] = 'admin';
			$user = $this->User->Save($user);
		}
		debugger::dump($user);
	}

	public function demo() {
        // Add a simple user
		$user = $this->User->findByUsername('user');
		if (empty($user)) {
			$user = $this->User->create();
			$user['User']['username'] = 'user';
			$user['User']['password'] = 'user';
			$user['User']['role'] = 'user';
			$user = $this->User->Save($user);
		}
		debugger::dump($user);

		// Add a couple of tanks for the demo user
		$lounge_tank = $this->Tank->findByName('Lounge');
		if (empty($lounge_tank)) {
			$lounge_tank = $this->Tank->create();
			$lounge_tank['Tank']['user_id'] = $user['User']['id'];
			$lounge_tank['Tank']['name'] = 'Lounge';
			$lounge_tank = $this->Tank->save($lounge_tank);
		}
		debugger::dump($lounge_tank);

		$kitchen_tank = $this->Tank->findByName('Lounge');
		if (empty($kitchen_tank)) {
			$kitchen_tank = $this->Tank->create();
			$kitchen_tank['Tank']['user_id'] = $user['User']['id'];
			$kitchen_tank['Tank']['name'] = 'Kitchen';
			$kitchen_tank = $this->Tank->save($kitchen_tank);
		}
		debugger::dump($kitchen_tank);


		// Add some species to the tanks
		$gold_id = $this->Species->field('id', array('name' => 'Gold Cobra Guppy'));
		$rasbora_id = $this->Species->field('id', array('name' => 'Purple Harlequin Rasbora'));
		$hillstream_id = $this->Species->field('id', array('name' => 'Gold Ring Butterfly Sucker'));
		$barb_id = $this->Species->field('id', array('name' => 'Rosy Barb'));
		$snakeskin_id = $this->Species->field('id', array('name' => 'Snakeskin Guppy'));
		$redshrimp_id = $this->Species->field('id', array('name' => 'Red Cherry Shrimp'));
		$shrimp_id = $this->Species->field('id', array('name' => 'Bamboo Shrimp'));

		$lounge_id = $this->Tank->field('id', array('name' => 'Lounge'));
		$kitchen_id = $this->Tank->field('id', array('name' => 'Kitchen'));

		$links = array();
		$links[] = array('tank_id' => $lounge_id, 'species_id' => $gold_id, 'quantity' => 2, 'created' => '2013-01-01', 'note' => '');
		$links[] = array('tank_id' => $lounge_id, 'species_id' => $rasbora_id, 'quantity' => 6, 'created' => '2013-01-01', 'note' => '');
		$links[] = array('tank_id' => $lounge_id, 'species_id' => $redshrimp_id, 'quantity' => 2, 'created' => '2013-01-01', 'note' => '');
		$links[] = array('tank_id' => $lounge_id, 'species_id' => $hillstream_id, 'quantity' => 2, 'created' => '2013-01-01', 'note' => '');
		$links[] = array('tank_id' => $lounge_id, 'species_id' => $barb_id, 'quantity' => 5, 'created' => '2013-01-01', 'note' => '');
		$links[] = array('tank_id' => $lounge_id, 'species_id' => $snakeskin_id, 'quantity' => 6, 'created' => '2013-01-19', 'note' => '');
		$links[] = array('tank_id' => $lounge_id, 'species_id' => $shrimp_id, 'quantity' => 3, 'created' => '2013-01-19', 'note' => '');
		$links[] = array('tank_id' => $lounge_id, 'species_id' => $shrimp_id, 'quantity' => -2, 'created' => '2013-01-20', 'note' => 'Dissappeared');
		$links[] = array('tank_id' => $lounge_id, 'species_id' => $barb_id, 'quantity' => -1, 'created' => '2013-01-20', 'note' => 'Found dead. Others look fine');
		$links[] = array('tank_id' => $lounge_id, 'species_id' => $shrimp_id, 'quantity' => 1, 'created' => '2013-01-27', 'note' => 'Found two hiding in the filter bracket');
		$links[] = array('tank_id' => $lounge_id, 'species_id' => $redshrimp_id, 'quantity' => -2, 'created' => '2013-01-27', 'note' => 'Found a corpse. No sign of others');
		$links[] = array('tank_id' => $lounge_id, 'species_id' => $rasbora_id, 'quantity' => -1, 'created' => '2013-02-03', 'note' => 'AWOL');
		$links[] = array('tank_id' => $lounge_id, 'species_id' => $barb_id, 'quantity' => -1, 'created' => '2013-02-16', 'note' => 'Found dead. Others look fine');

		$this->SpeciesTransaction->saveAll($links);
		debugger::dump($links);

	}

}