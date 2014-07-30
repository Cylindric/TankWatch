<?php

namespace App\Controller;

use Cake\Event\Event;

class InstallController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->loadModel('Installs');
        $this->loadModel('Users');
        $this->loadModel('Units');
        $this->loadModel('Species');

        // If nothing installed, allow the install action
        if ($this->Installs->CurrentSchemaVersion() === 0) {
            $this->Auth->allow(['install']);
        }

        // If no users exist, allow the install action
        if ($this->Users->find()->count() === 0) {
            $this->Auth->allow(['install']);
        }
    }

    public function index() {
        
    }

    public function install() {
        $messages = array();

        $original_version = $this->Installs->CurrentSchemaVersion();
        $this->Installs->UpdateSchema($messages);
        $current_version = $this->Installs->CurrentSchemaVersion();

        if ($original_version === $current_version) {
            $messages[] = sprintf('No upgrade was required. Current version matches target version (%s).', $current_version);
        }

        if ($original_version == 1) {
            $this->InstallCoreData($messages);
        }

        $this->set('messages', $messages);
    }

    private function InstallCoreData(&$messages) {
        if ($this->Users->find()->where(['username' => 'admin'])->count() === 0) {
            $messages[] = 'No users found, creating "admin".';
            $user = $this->Users->newEntity([
                'username' => 'admin',
                'name' => 'Admin',
                'password' => 'admin',
                'role' => 'admin',
                'email' => 'admin@example.local'
            ]);
            $this->Users->save($user);
        }

        $units = [
            ['name' => 'Text', 'abbreviation' => ''],
            ['name' => 'Unit', 'abbreviation' => ''],
            ['name' => 'Degrees Celsius', 'abbreviation' => '°C'],
            ['name' => 'Degress Farenheit', 'abbreviation' => '°F'],
            ['name' => 'Parts per million', 'abbreviation' => 'ppm'],
            ['name' => 'pH', 'abbreviation' => ''],
            ['name' => 'Centimetre', 'abbreviation' => 'cm'],
            ['name' => 'Litre', 'abbreviation' => 'L'],
        ];
        foreach ($units as $new) {
            if ($this->Units->find()->where($new)->count() == 0) {
                $this->Units->save($this->Units->newEntity($new));
                $messages[] = sprintf('Added missing unit <em>%s</em>.', $new['name']);
            }
        }

        $species = [
            ['name' => 'Gold Cobra Guppy', 'scientific_class' => 'Actinopterygii', 'scientific_name' => 'Poecilia reticulata'],
            ['name' => 'Purple Harlequin Rasbora', 'scientific_class' => 'Actinopterygii', 'scientific_name' => 'Trigonostigma heteromorpha'],
            ['name' => 'Red Cherry Shrimp', 'scientific_class' => 'Malacostraca', 'scientific_name' => 'Neocaridina heteropoda'],
            ['name' => 'Gold Ring Butterfly Sucker', 'scientific_class' => 'Actinopterygii', 'scientific_name' => 'Balitora lineolata'],
            ['name' => 'Rosy Barb', 'scientific_class' => 'Actinopterygii', 'scientific_name' => 'Pethia conchonius'],
            ['name' => 'Snakeskin Guppy', 'scientific_class' => 'Actinopterygii', 'scientific_name' => 'Poecilia reticulata'],
            ['name' => 'Bamboo Shrimp', 'scientific_class' => 'Malacostraca', 'scientific_name' => 'Atyopsis'],
            ['name' => 'Red Tailed Shark', 'scientific_class' => 'Actinopterygii', 'scientific_name' => 'Epalzeorhynchos bicolor'],
        ];
        foreach ($species as $new) {
            if ($this->Species->find()->where($new)->count() == 0) {
                $this->Species->save($this->Species->newEntity($new));
                $messages[] = sprintf('Added missing Species <em>%s</em>.', $new['name']);
            }
        }
    }

}
