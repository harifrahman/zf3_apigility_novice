<?php
namespace Usage\V1\Service;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class UsageFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config')['project'];
        $usageService = new Usage();
        $usageService->setConfig($config);
        return $usageService;
    }
}
