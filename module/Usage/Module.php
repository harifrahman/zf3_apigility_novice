<?php
namespace Usage;

use Zend\Mvc\MvcEvent;
use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements ApigilityProviderInterface
{
    public function onBootstrap(MvcEvent $mvcEvent)
    {
        $serviceManager = $mvcEvent->getApplication()->getServiceManager();

        //Customer
        $customerService = $serviceManager->get(\Usage\V1\Service\Customer::class);
        $customerEventListener = $serviceManager->get(\Usage\V1\Service\Listener\CustomerEventListener::class);
        $customerEventListener->attach($customerService->getEventManager());

        //Usage
        $usageService = $serviceManager->get(\Usage\V1\Service\Usage::class);
        $usageEventListener = $serviceManager->get(\Usage\V1\Service\Listener\UsageEventListener::class);
        $usageEventListener->attach($usageService->getEventManager());
    }

    public function getConfig()
    {
        $config = [];
        $configFiles = [
            __DIR__ . '/config/module.config.php',
            __DIR__ . '/config/doctrine.config.php',  // configuration for doctrine
        ];

        // merge all module config options
        foreach ($configFiles as $configFile) {
            $config = \Zend\Stdlib\ArrayUtils::merge($config, include $configFile, true);
        }

        return $config;
    }

    public function getAutoloaderConfig()
    {
        return [
            'ZF\Apigility\Autoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src',
                ],
            ],
        ];
    }
}
