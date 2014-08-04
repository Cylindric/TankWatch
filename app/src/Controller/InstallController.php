<?php

namespace App\Controller;

use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;
use App\Model\Entity\Speciesproperty;
use App\Model\Entity\Property;
use Cake\Utility\Debugger;

class InstallController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->loadModel('Installs');
        $this->loadModel('Users');
        $this->loadModel('Units');
        $this->loadModel('Species');
        $this->loadModel('Propertytypes');
        $this->loadModel('Properties');
        $this->loadModel('SpeciesProperties');

        if ($this->Installs->CurrentSchemaVersion() === 0) {
            // If nothing installed, allow the install action
            $this->Auth->allow(['install']);
        } elseif ($this->Users->find()->count() === 0) {
            // If no users exist, allow the install action
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

        $propertytypes = [
            ['name' => 'Temperature', 'code' => 'temp', 'display_format' => '%.1f', 'is_test' => true],
            ['name' => 'Acidity', 'code' => 'pH', 'display_format' => '%.1f', 'is_test' => true],
            ['name' => 'General Hardness', 'code' => 'GH', 'display_format' => '%d', 'is_test' => true],
            ['name' => 'Carbonate Hardness', 'code' => 'KH', 'display_format' => '%d', 'is_test' => true],
            ['name' => 'Nitrites', 'code' => 'NO<sub>2</sub>', 'display_format' => '%.1f', 'is_test' => true],
            ['name' => 'Nitrates', 'code' => 'NO<sub>3</sub>', 'display_format' => '%.1f', 'is_test' => true],
            ['name' => 'Ammonia', 'code' => 'NH<sub>3</sub>', 'display_format' => '%.1f', 'is_test' => true],
            ['name' => 'Ammonium', 'code' => 'NH<sub>4</sub>', 'display_format' => '%.1f', 'is_test' => true],
            ['name' => 'Length', 'code' => 'Length', 'display_format' => '%.0f', 'is_test' => false],
        ];
        foreach ($propertytypes as $new) {
            if ($this->Propertytypes->find()->where($new)->count() == 0) {
                $this->Propertytypes->save($this->Propertytypes->newEntity($new));
                $messages[] = sprintf('Added missing Property Type <em>%s</em>.', $new['name']);
            }
        }

        $species = [
            ['name' => 'Gold Cobra Guppy', 'scientific_class' => 'Actinopterygii', 'scientific_name' => 'Poecilia reticulata'],
            ['name' => 'Purple Harlequin Rasbora', 'scientific_class' => 'Actinopterygii', 'scientific_name' => 'Trigonostigma heteromorpha'],
            ['name' => 'Red Cherry Shrimp', 'scientific_class' => 'Malacostraca', 'scientific_name' => 'Neocaridina heteropoda'],
            ['name' => 'Gold Ring Butterfly Loach', 'scientific_class' => 'Actinopterygii', 'scientific_name' => 'Balitora lineolata'],
            ['name' => 'Rosy Barb', 'scientific_class' => 'Actinopterygii', 'scientific_name' => 'Pethia conchonius'],
            ['name' => 'Snakeskin Guppy', 'scientific_class' => 'Actinopterygii', 'scientific_name' => 'Poecilia reticulata'],
            ['name' => 'Bamboo Shrimp', 'scientific_class' => 'Malacostraca', 'scientific_name' => 'Atyopsis'],
            ['name' => 'Ram Cichlid', 'scientific_class' => 'Actinopterygii', 'scientific_name' => 'Mikrogeophagus ramirezi'],
            ['name' => 'Red Tailed Shark', 'scientific_class' => 'Actinopterygii', 'scientific_name' => 'Epalzeorhynchos bicolor'],
        ];
        foreach ($species as $new) {
            if ($this->Species->find()->where($new)->count() == 0) {
                $this->Species->save($this->Species->newEntity($new));
                $messages[] = sprintf('Added missing Species <em>%s</em>.', $new['name']);
            }
        }

        // Add some properties to the demo species
        $p_temp = $this->Propertytypes->find()->where(['code' => 'temp'])->first();
        $p_ph = $this->Propertytypes->find()->where(['code' => 'pH'])->first();

        $s = $this->Species->find()->where(['name' => 'Bamboo Shrimp'])->contain(['Properties'])->first();
        $s->properties = [
            new Property(['propertytype' => $p_ph, 'valuetype_id' => '1', 'value' => 6.5, 'source' => 'demo']),
            new Property(['propertytype' => $p_ph, 'valuetype_id' => '2', 'value' => 7.8, 'source' => 'demo']),
            new Property(['propertytype' => $p_temp, 'valuetype_id' => '1', 'value' => 21.1, 'source' => 'demo']),
            new Property(['propertytype' => $p_temp, 'valuetype_id' => '2', 'value' => 25.6, 'source' => 'demo'])
        ];
        $this->Species->save($s);

        $s = $this->Species->find()->where(['name' => 'Gold Ring Butterfly Loach'])->contain(['Properties'])->first();
        $s->properties = [
            new Property(['propertytype' => $p_ph, 'valuetype_id' => '1', 'value' => 6.5, 'source' => 'demo']),
            new Property(['propertytype' => $p_ph, 'valuetype_id' => '2', 'value' => 7.5, 'source' => 'demo']),
            new Property(['propertytype' => $p_temp, 'valuetype_id' => '1', 'value' => 20.0, 'source' => 'demo']),
            new Property(['propertytype' => $p_temp, 'valuetype_id' => '2', 'value' => 23.8, 'source' => 'demo'])
        ];
        $this->Species->save($s);

        $s = $this->Species->find()->where(['name' => 'Purple Harlequin Rasbora'])->contain(['Properties'])->first();
        $s->properties = [
            new Property(['propertytype' => $p_ph, 'valuetype_id' => '1', 'value' => 6.0, 'source' => 'demo']),
            new Property(['propertytype' => $p_ph, 'valuetype_id' => '2', 'value' => 7.5, 'source' => 'demo']),
            new Property(['propertytype' => $p_temp, 'valuetype_id' => '1', 'value' => 23.3, 'source' => 'demo']),
            new Property(['propertytype' => $p_temp, 'valuetype_id' => '2', 'value' => 27.8, 'source' => 'demo'])
        ];
        $this->Species->save($s);

        $s = $this->Species->find()->where(['name' => 'Ram Cichlid'])->contain(['Properties'])->first();
        $s->properties = [
            new Property(['propertytype' => $p_ph, 'valuetype_id' => '1', 'value' => 5.0, 'source' => 'demo']),
            new Property(['propertytype' => $p_ph, 'valuetype_id' => '2', 'value' => 7.0, 'source' => 'demo']),
            new Property(['propertytype' => $p_temp, 'valuetype_id' => '1', 'value' => 22.2, 'source' => 'demo']),
            new Property(['propertytype' => $p_temp, 'valuetype_id' => '2', 'value' => 26.1, 'source' => 'demo'])
        ];
        $this->Species->save($s);

        $s = $this->Species->find()->where(['name' => 'Rosy Barb'])->contain(['Properties'])->first();
        $s->properties = [
            new Property(['propertytype' => $p_ph, 'valuetype_id' => '1', 'value' => 6.0, 'source' => 'demo']),
            new Property(['propertytype' => $p_ph, 'valuetype_id' => '2', 'value' => 8.0, 'source' => 'demo']),
            new Property(['propertytype' => $p_temp, 'valuetype_id' => '1', 'value' => 18.0, 'source' => 'demo']),
            new Property(['propertytype' => $p_temp, 'valuetype_id' => '2', 'value' => 22.0, 'source' => 'demo'])
        ];
        $this->Species->save($s);

    }

}
