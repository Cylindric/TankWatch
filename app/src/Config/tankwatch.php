<?php

$config = [
    'db.version' => 1,
    'Security' => [
        'salt' => 'JKEy5mL5CB01bpb883scdxDviaCzhPdBWEBQ0BAzL0q464rpYP59P7XmkK4e',
    ],
    'Datasources' => [
        'default' => [
                'className' => 'Cake\Database\Connection',
                'driver' => 'Cake\Database\Driver\Mysql',
                'persistent' => false,
                'host' => 'localhost',
                'login' => 'tankwatch',
                'password' => 'tankwatch',
                'database' => 'tankwatch3',
                'prefix' => false,
                'encoding' => 'utf8',
                'timezone' => 'UTC',
                'quoteIdentifiers' => false,
                'cacheMetadata' => true,
        ],
    ],
];
