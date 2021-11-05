<?php
return [
    'db' => [
        'adapters' => [
            'zf3_mysql' => [
                'database' => 'tirtanadi',
                'driver' => 'PDO_Dblib',
                'hostname' => 'LAPTOP-LR7H9DSN\\XTEND',
                'username' => 'sa',
                'password' => '12345678',
                'port' => '1433',
                'dsn' => 'sqlsrv:Server=LAPTOP-LR7H9DSN\\XTEND,1433;Database=tirtanadi',
            ],
        ],
    ],
    'zf-mvc-auth' => [
        'authentication' => [
            'adapters' => [
                'oauth2_pdo' => [
                    'adapter' => \ZF\MvcAuth\Authentication\OAuth2Adapter::class,
                    'storage' => [
                        'storage' => 'user.auth.pdo.adapter',
                    ],
                ],
            ],
        ],
    ],
];
