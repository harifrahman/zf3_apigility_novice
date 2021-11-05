<?php
return [
    'service_manager' => [
        'factories' => [
            \Usage\V1\Rest\Customer\CustomerResource::class => \Usage\V1\Rest\Customer\CustomerResourceFactory::class,
            \Usage\V1\Service\Customer::class => \Usage\V1\Service\CustomerFactory::class,
            \Usage\V1\Service\Listener\CustomerEventListener::class => \Usage\V1\Service\Listener\CustomerEventListenerFactory::class,
            \Usage\V1\Rest\Usage\UsageResource::class => \Usage\V1\Rest\Usage\UsageResourceFactory::class,
            \Usage\V1\Service\Usage::class => \Usage\V1\Service\UsageFactory::class,
            \Usage\V1\Service\Listener\UsageEventListener::class => \Usage\V1\Service\Listener\UsageEventListenerFactory::class,
        ],
        'abstract_factories' => [
            0 => \Usage\Mapper\AbstractMapperFactory::class,
        ],
    ],
    'hydrators' => [
        'factories' => [
            'Usage\\Hydrator\\Customer' => \Usage\V1\Hydrator\CustomerHydratorFactory::class,
            'Usage\\Hydrator\\Usage' => \Usage\V1\Hydrator\UsageHydratorFactory::class,
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
            'entity_class' => \Usage\Entity\Customer::class,
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
            'entity_class' => \Usage\Entity\Usage::class,
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
            'Usage\\V1\\Rest\\Customer\\CustomerEntity' => [
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
            'Usage\\V1\\Rest\\Usage\\UsageEntity' => [
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
            \Usage\Entity\Customer::class => [
                'entity_identifier_name' => 'uuid',
                'route_name' => 'usage.rest.customer',
                'route_identifier_name' => 'uuid',
                'hydrator' => 'Usage\\Hydrator\\Customer',
            ],
            'Usage\\Entity\\UsageEntity' => [
                'entity_identifier_name' => 'uuid',
                'route_name' => 'usage.rest.usage',
                'route_identifier_name' => 'uuid',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \Usage\Entity\Usage::class => [
                'entity_identifier_name' => 'uuid',
                'route_name' => 'usage.rest.usage',
                'route_identifier_name' => 'uuid',
                'hydrator' => 'Usage\\Hydrator\\Usage',
            ],
        ],
    ],
    'zf-mvc-auth' => [
        'authorization' => [
            'Usage\\V1\\Rest\\Customer\\Controller' => [
                'collection' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
            ],
            'Usage\\V1\\Rest\\Usage\\Controller' => [
                'collection' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
            ],
        ],
    ],
    'zf-content-validation' => [
        'Usage\\V1\\Rest\\Customer\\Controller' => [
            'input_filter' => 'Usage\\V1\\Rest\\Customer\\Validator',
        ],
        'Usage\\V1\\Rest\\Usage\\Controller' => [
            'input_filter' => 'Usage\\V1\\Rest\\Usage\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Usage\\V1\\Rest\\Customer\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                        'options' => [],
                    ],
                ],
                'name' => 'firstName',
            ],
            1 => [
                'required' => false,
                'validators' => [],
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                        'options' => [],
                    ],
                ],
                'name' => 'lastName',
            ],
            2 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\EmailAddress::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'email',
            ],
            3 => [
                'required' => true,
                'validators' => [],
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                        'options' => [],
                    ],
                ],
                'name' => 'address',
            ],
            4 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\I18n\Validator\Alnum::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'postalCode',
            ],
            5 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'isActive',
            ],
            6 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'customerId',
            ],
            7 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'waterMeterId',
            ],
            8 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'lastStandMeter',
            ],
        ],
        'Usage\\V1\\Rest\\Usage\\Validator' => [
            0 => [
                'required' => false,
                'validators' => [],
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                        'options' => [],
                    ],
                ],
                'name' => 'usageId',
            ],
            1 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\File\Extension::class,
                        'options' => [
                            'extension' => 'png, jpg, jpeg',
                            'message' => 'Extension not allowed',
                        ],
                    ],
                    1 => [
                        'name' => \Zend\Validator\File\MimeType::class,
                        'options' => [
                            'mimeType' => 'image/png, image/jpeg',
                            'message' => 'Mimetype not allowed',
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\File\RenameUpload::class,
                        'options' => [
                            'randomize' => true,
                            'use_upload_extension' => true,
                            'target' => 'data/usage',
                        ],
                    ],
                ],
                'name' => 'photo',
            ],
            2 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'month',
            ],
            3 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'year',
            ],
            4 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'lastStandMeter',
            ],
            5 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'currentMeter',
            ],
            6 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\Uuid::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'customer',
            ],
            7 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\Uuid::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'userProfile',
            ],
        ],
    ],
];
