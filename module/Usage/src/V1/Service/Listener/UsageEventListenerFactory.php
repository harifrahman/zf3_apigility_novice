<?php
namespace Usage\V1\Service\Listener;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class UsageEventListenerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $usageMapper = $container->get(\Usage\Mapper\Usage::class);
        $usageHydrator = $container->get('HydratorManager')->get('Usage\Hydrator\Usage');
        $usageEventListener = new UsageEventListener(
            $usageMapper
        );
        $usageEventListener->setLogger($container->get("logger_default"));
        $usageEventListener->setUsageHydrator($usageHydrator);
        return $usageEventListener;
    }
}
