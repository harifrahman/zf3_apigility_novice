<?php
return [
    'doctrine' => [
        'connection' => [
            // default connection name
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOSqlsrv\Driver',
                'params' => [
                    'host'     => 'LAPTOP-LR7H9DSN\\XTEND',
                    'user'     => 'sa',
                    'password' => '12345678',
                    'dbname'   => 'tirtanadi',
                    'port'     => '1433'
                ],
            ],
        ],
    ],
];
