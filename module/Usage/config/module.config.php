<?php
return [
    'service_manager' => [
        'factories' => [
            \Usage\V1\Rest\Customer\CustomerResource::class => \Usage\V1\Rest\Customer\CustomerResourceFactory::class,
            \Usage\V1\Rest\Usage\UsageResource::class => \Usage\V1\Rest\Usage\UsageResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'usage.rest.customer' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/api/v1/customer[/:uuid]',
                    'defaults' => [
                        'controller' => 'Usage\\V1\\Rest\\Customer\\Controller',
                    ],
                ],
            ],
            'usage.rest.usage' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/api/v1/usage[/:uuid]',
                    'defaults' => [
                        'controller' => 'Usage\\V1\\Rest\\Usage\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'usage.rest.customer',
            1 => 'usage.rest.usage',
        ],
    ],
    'zf-rest' => [
        'Usage\\V1\\Rest\\Customer\\Controller' => [
            'listener' => \Usage\V1\Rest\Customer\CustomerResource::class,
            'route_name' => 'usage.rest.customer',
            'route_identifier_name' => 'uuid',
            'collection_name' => 'customer',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                0 => 'order',
                1 => 'ascending',
            ],
            'page_size' => 25,
            'page_size_param' => 'limit',
            'entity_class' => 'Usage\\Entity\\Customer',
            'collection_class' => \Usage\V1\Rest\Customer\CustomerCollection::class,
            'service_name' => 'Customer',
        ],
        'Usage\\V1\\Rest\\Usage\\Controller' => [
            'listener' => \Usage\V1\Rest\Usage\UsageResource::class,
            'route_name' => 'usage.rest.usage',
            'route_identifier_name' => 'uuid',
            'collection_name' => 'usage',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                0 => 'order',
                1 => 'ascending',
            ],
            'page_size' => 25,
            'page_size_param' => 'limit',
            'entity_class' => 'Usage\\Entity\\Usage',
            'collection_class' => \Usage\V1\Rest\Usage\UsageCollection::class,
            'service_name' => 'Usage',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'Usage\\V1\\Rest\\Customer\\Controller' => 'HalJson',
            'Usage\\V1\\Rest\\Usage\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'Usage\\V1\\Rest\\Customer\\Controller' => [
                0 => 'application/hal+json',
                1 => 'application/json',
            ],
            'Usage\\V1\\Rest\\Usage\\Controller' => [
                0 => 'application/hal+json',
                1 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Usage\\V1\\Rest\\Customer\\Controller' => [
                0 => 'application/json',
            ],
            'Usage\\V1\\Rest\\Usage\\Controller' => [
                0 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \Usage\V1\Rest\Customer\CustomerEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'usage.rest.customer',
                'route_identifier_name' => 'customer_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \Usage\V1\Rest\Customer\CustomerCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'usage.rest.customer',
                'route_identifier_name' => 'customer_id',
                'is_collection' => true,
            ],
            \Usage\V1\Rest\Usage\UsageEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'usage.rest.usage',
                'route_identifier_name' => 'usage_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \Usage\V1\Rest\Usage\UsageCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'usage.rest.usage',
                'route_identifier_name' => 'usage_id',
                'is_collection' => true,
            ],
            'Usage\\Entity\\Customer' => [
                'entity_identifier_name' => 'uuid',
                'route_name' => 'usage.rest.customer',
                'route_identifier_name' => 'uuid',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            'Usage\\Entity\\UsageEntity' => [
                'entity_identifier_name' => 'uuid',
                'route_name' => 'usage.rest.usage',
                'route_identifier_name' => 'uuid',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            'Usage\\Entity\\Usage' => [
                'entity_identifier_name' => 'uuid',
                'route_name' => 'usage.rest.usage',
                'route_identifier_name' => 'uuid',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
        ],
    ],
    'zf-mvc-auth' => [
        'authorization' => [
            'Usage\\V1\\Rest\\Customer\\Controller' => [
                'collection' => [
                    'GET' => true,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => true,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => true,
                    'DELETE' => true,
                ],
            ],
            'Usage\\V1\\Rest\\Usage\\Controller' => [
                'collection' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => true,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => true,
                    'DELETE' => true,
                ],
            ],
        ],
    ],
];
