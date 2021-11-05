<?php
namespace Usage\V1\Rest\Customer;

class CustomerResourceFactory
{
    public function __invoke($services)
    {
        $userProfileMapper = $services->get('User\Mapper\UserProfile');
        $customerMapper  = $services->get(\Usage\Mapper\Customer::class);
        $customerService = $services->get(\Usage\V1\Service\Customer::class);
        $resource = new CustomerResource(
            $userProfileMapper,
            $customerMapper
        );
        $resource->setCustomerService($customerService);
        return $resource;
    }
}
