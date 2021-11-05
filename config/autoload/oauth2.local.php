<?php
return [
    'zf-oauth2' => [
        'storage' => 'user.auth.pdo.adapter',
        'db' => [
           	'dsn' => 'sqlsrv:Server=LAPTOP-LR7H9DSN\\XTEND,1433;Database=tirtanadi',
           	'route' => '/oauth',
           	'username' => 'sa',
           	'password' => '12345678',
            'host' => 'LAPTOP-LR7H9DSN\\XTEND',
            'port' => '1433'
       	],
       	'options' => [
            'always_issue_new_refresh_token' => true,
            'unset_refresh_token_after_use' => true,
        ],
        'allow_implicit' => false, // default (set to true when you need to support browser-based or mobile apps)
        'access_lifetime' => 3600 * 100, // default (set a value in seconds for access tokens lifetime)
        'enforce_state'  => true,  // default
    ],
];
