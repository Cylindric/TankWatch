<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class InstallsTable extends Table {

    public $useTable = false;

    public function getCurrentSchemaVersion() {
//        $this->Version = ClassRegistry::init('Version');
        $v = 0;
//
//        // Does the main version table exist? If so, get the current schema version.
//        $result = $this->query("SHOW TABLES LIKE 'versions'");
//        if (!empty($result)) {
//            $v = (int) $this->Version->field('version', array('id >' => 0), 'id DESC');
//        }
//
        return $v;
    }

    public function updateSchema(&$messages) {
//        $v_current = $this->getCurrentSchemaVersion();
//        $v_required = (int) Configure::read('db.version');
//
//        $messages[] = "Current version: $v_current";
//        $messages[] = "Required version: $v_required";
//
//        $step = $v_current + 1;
//
//        if ($v_current === 0) {
//
//            // If there is no current version, just install 'complete'        
//            $file = APP . 'Config' . DS . 'Schema' . DS . 'Migrations' . DS . 'complete.sql';
//            $this->processScript($file, $messages);
//        } else {
//
//            // Run all migration scripts between Current and Required
//            for ($step = $v_current + 1; $step <= $v_required; $step++) {
//                $file = APP . 'Config' . DS . 'Schema' . DS . 'Migrations' . DS . str_pad($step, 3, '0', STR_PAD_LEFT) . '.sql';
//                $messages[] = "Checking for migration script $file";
//                if (file_exists($file)) {
//                    $messages[] = "processing $step";
//                    $this->processScript($file, $messages);
//
//                    // should now be at version $step
//                    if ($this->getCurrentSchemaVersion() !== $step) {
//                        $messages[] = "Failed processing at step $step!";
//                        break;
//                    }
//                }
//            }
//        }
//
//        // should now be at version $step
//        if ($this->getCurrentSchemaVersion() !== $v_required) {
//            $messages[] = "Upgrade failed!";
//        }
//
        return $messages;
    }

//    private function processScript($filename, &$messages) {
//        $fileContent = file_get_contents($filename);
//        $commands = split(';', $fileContent);
//        foreach ($commands as $command) {
//            $command = trim($command);
//            if (substr($command, 0, 2) === '/*') {
//                $message = $command;
//                $message = str_replace('/*', '', $message);
//                $message = str_replace('*/', '', $message);
//                $messages[] = 'SQL: ' . trim($message);
//                $command = '';
//            }
//            if (!empty($command)) {
//                $this->query($command);
//            }
//        }
//    }

}
