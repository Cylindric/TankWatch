<?php

class InstallController extends AppController {

    public $uses = array('Install', 'Result', 'Species', 'SpeciesTransaction', 'Tank', 'Test', 'User', 'Unit', 'TestSet');

    public function beforeFilter() {
        // If there are not users at all yet, then allow access to the install
        try {
            if ($this->User->find('count') === 0) {
                $this->Auth->allow('install');
            }
        } catch (Exception $e) {
            if (get_class($e) === 'MissingTableException') {
                $this->Auth->allow('install');
            }
        }
    }

    public function index() {
        
    }

    public function install() {
        $messages = array();

        // Update the schema
        $original_version = $this->Install->getCurrentSchemaVersion();
        $this->Install->updateSchema($messages);
        $current_version = $this->Install->getCurrentSchemaVersion();

        if ($original_version === $current_version) {
            $messages[] = sprintf('Nothing upgrade was required. Current version matches target version (%s).', $current_version);
        }

        // Add an admin user
        $user = $this->User->findByUsername('admin');
        if (empty($user)) {
            $messages[] = 'No users found, creating "admin".';
            $user = $this->User->create();
            $user['User']['username'] = 'admin';
            $user['User']['password'] = 'admin';
            $user['User']['role'] = 'admin';
            $user = $this->User->Save($user);
        }

        // Insert core Units
        if ($this->Unit->find('count') === 0) {
            $messages[] = 'No units found, creating core units.';
            $this->Unit->saveAll(
                    array(
                        array('name' => 'Unit', 'abbreviation' => ''),
                        array('name' => 'Degrees Celsius', 'abbreviation' => '°C'),
                        array('name' => 'Degress Farenheit', 'abbreviation' => '°F'),
                        array('name' => 'Parts per million', 'abbreviation' => 'ppm'),
                        array('name' => 'pH', 'abbreviation' => ''),
                    )
            );
        }

        // Insert core Species
        $species = array(
            array('name' => 'Gold Cobra Guppy', 'scientific_class' => 'Actinopterygii', 'scientific_name' => 'Poecilia reticulata'),
            array('name' => 'Purple Harlequin Rasbora', 'scientific_class' => 'Actinopterygii', 'scientific_name' => 'Trigonostigma heteromorpha'),
            array('name' => 'Red Cherry Shrimp', 'scientific_class' => 'Malacostraca', 'scientific_name' => 'Neocaridina heteropoda'),
            array('name' => 'Gold Ring Butterfly Sucker', 'scientific_class' => 'Actinopterygii', 'scientific_name' => 'Balitora lineolata'),
            array('name' => 'Rosy Barb', 'scientific_class' => 'Actinopterygii', 'scientific_name' => 'Pethia conchonius'),
            array('name' => 'Snakeskin Guppy', 'scientific_class' => 'Actinopterygii', 'scientific_name' => 'Poecilia reticulata'),
            array('name' => 'Bamboo Shrimp', 'scientific_class' => 'Malacostraca', 'scientific_name' => 'Atyopsis'),
            array('name' => 'Red Tailed Shark', 'scientific_class' => 'Actinopterygii', 'scientific_name' => 'Epalzeorhynchos bicolor'),
        );
        for ($i = 0; $i < count($species); $i++) {
            $species[$i]['id'] = $this->Species->field('id', array('name' => $species[$i]['name']));
        }
        $messages[] = sprintf('Updating %s core species', count($species));
        $this->Species->saveAll($species);


        // Insert core Tests
        if ($this->Test->find('count') === 0) {
            $messages[] = 'No tests found, creating core tests.';
            $this->Test->saveAll(
                    array(
                        array('name' => 'Temperature', 'code' => 'temp', 'display_format' => '%.1d'),
                        array('name' => 'Acidity', 'code' => 'pH', 'display_format' => '%.1f'),
                        array('name' => 'Nitrites', 'code' => 'NO<sub>2</sub>', 'display_format' => '%.1f'),
                        array('name' => 'Nitrates', 'code' => 'NO<sub>3</sub>', 'display_format' => '%.1f'),
                        array('name' => 'Ammonia', 'code' => 'NH<sub>3</sub>', 'display_format' => '%.1f'),
                        array('name' => 'Ammonium', 'code' => 'NH<sub>4</sub>', 'display_format' => '%.1f'),
                    )
            );
        }

        $this->set(compact('messages'));
    }

    public function demo() {
        $messages = array();
        
        // Add a simple user
        $users = array(
            array('username' => 'user', 'password' => 'user', 'role' => 'user', 'is_active' => 1),
        );
        for ($i = 0; $i < count($users); $i++) {
            $users[$i]['id'] = $this->Users->field('id', array('username' => $users[$i]['username']));
        }
        $messages[] = sprintf('Updating demo users', count($tanks));
        $this->Users->saveAll($users);

        
        // Add a couple of tanks for the demo user
        $tanks = array(
            array('name' => 'Lounge', 'width' => 60, 'depth' => 30, 'height' => 40),
            array('name' => 'Kitchen', 'width' => 60, 'depth' => 30, 'height' => 40),
        );
        for ($i = 0; $i < count($tanks); $i++) {
            $tanks[$i]['id'] = $this->Tanks->field('id', array('name' => $tanks[$i]['name'], 'user_id' => $user['User']['id']));
        }
        $messages[] = sprintf('Updating demo tanks', count($tanks));
        $this->Tanks->saveAll($tanks);



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
        $links[] = array('tank_id' => $lounge_id, 'species_id' => $barb_id, 'quantity' => -4, 'created' => '2013-02-19', 'note' => 'Moved barbs into the kitchen');
        $links[] = array('tank_id' => $kitchen_id, 'species_id' => $barb_id, 'quantity' => 4, 'created' => '2013-02-19', 'note' => 'Moved barbs into the kitchen');

        $this->SpeciesTransaction->saveAll($links);
        $messages[] = 'Added some species transactions to the tanks';

        $this->set(compact('messages'));
    }

}