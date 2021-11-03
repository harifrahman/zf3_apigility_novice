<?php
namespace Usage\V1\Rest\Customer;

class CustomerResourceFactory
{
    public function __invoke($services)
    {
        return new CustomerResource();
    }
}
