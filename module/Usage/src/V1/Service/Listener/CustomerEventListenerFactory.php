<?php
namespace Usage\V1\Service\Listener;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class CustomerEventListenerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $customerMapper = $container->get(\Usage\Mapper\Customer::class);
        $customerHydrator = $container->get('HydratorManager')->get('Usage\Hydrator\Customer');
        $customerEventListener = new CustomerEventListener(
            $customerMapper
        );
        $customerEventListener->setLogger($container->get("logger_default"));
        $customerEventListener->setCustomerHydrator($customerHydrator);
        return $customerEventListener;
    }
}
