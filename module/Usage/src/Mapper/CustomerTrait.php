<?php

namespace Usage\Mapper;

/**
 * @author Arif Rahman Hakim <harifrahman999@gmail.com>
 *
 * Customer Trait
 */
trait CustomerTrait
{
    /**
     * @var \Usage\Mapper\Customer
     */
    protected $customerMapper;

    /**
     * Get the value of customerMapper
     *
     * @return  \Usage\Mapper\Customer
     */ 
    public function getCustomerMapper()
    {
        return $this->customerMapper;
    }

    /**
     * Set the value of customerMapper
     *
     * @param  \Usage\Mapper\Customer  $customerMapper
     *
     * @return  self
     */ 
    public function setCustomerMapper(\Usage\Mapper\Customer $customerMapper)
    {
        $this->customerMapper = $customerMapper;

        return $this;
    }
}
