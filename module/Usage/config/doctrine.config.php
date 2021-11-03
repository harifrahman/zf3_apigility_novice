<?php
return [
    'doctrine' => [
        'driver' => [
            'usage_entity' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/orm']
            ],
            'orm_default' => [
                'drivers' => [
                    'Usage\Entity' => 'usage_entity',
                ]
            ]
        ],
    ],
];
