<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Core\Configure;

class InstallsTable extends Table {

    public $useTable = false;

    public function CurrentSchemaVersion() {
        // Does the main version table exist? If so, get the current schema version.
        $version = 0;

        $con = ConnectionManager::get('default');
        $result = $con->query("SHOW TABLES LIKE 'installs'")->fetch('assoc');

        if ($result !== false) {
            $version = $this->find()
                            ->select(['version'])
                            ->order(['id' => 'DESC'])
                            ->first()->version;
        }

        return $version;
    }

    public function UpdateSchema(&$messages) {
        $v_current = $this->CurrentSchemaVersion();
        $v_required = (int) Configure::read('db.version');
        $messages[] = "Current version: $v_current";
        $messages[] = "Required version: $v_required";

        $step = $v_current + 1;

        if ($v_current === 0) {

            // If there is no current version, just install 'complete'        
            $file = APP . 'Config' . DS . 'Schema' . DS . 'install.sql';
            $this->processScript($file, $messages);
        } else {

            // Run all migration scripts between Current and Required
            for ($step = $v_current + 1; $step <= $v_required; $step++) {
                $file = APP . 'Config' . DS . 'Schema' . DS . 'Migrations' . DS . str_pad($step, 3, '0', STR_PAD_LEFT) . '.sql';
                $messages[] = "Checking for migration script $file";
                if (file_exists($file)) {
                    $messages[] = "processing $step";
                    $this->ProcessScript($file, $messages);

                    // should now be at version $step
                    if ($this->CurrentSchemaVersion() !== $step) {
                        $messages[] = "Failed processing at step $step!";
                        break;
                    }
                }
            }
        }

        // should now be at version $step
        if ($this->CurrentSchemaVersion() !== $v_required) {
            $messages[] = "Upgrade failed!";
        }

        return $messages;
    }

    private function processScript($filename, &$messages) {
        $con = ConnectionManager::get('default');
        $fileContent = file_get_contents($filename);
        $commands = split(';', $fileContent);
        foreach ($commands as $command) {
            $command = trim($command);
            if (substr($command, 0, 2) === '/*') {
                $message = $command;
                $message = str_replace('/*', '', $message);
                $message = str_replace('*/', '', $message);
                $messages[] = 'SQL: ' . trim($message);
                $command = '';
            }
            if (!empty($command)) {
                $con->execute($command);
            }
        }
    }

}
