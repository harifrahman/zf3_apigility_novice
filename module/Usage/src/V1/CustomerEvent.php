<?php

namespace Usage\V1;

use Zend\EventManager\Event;
use Zend\InputFilter\InputFilterInterface;
use \Exception;
use Usage\Entity\Customer as CustomerEntity;

class CustomerEvent extends Event
{
    /**#@+
    * Customer events triggered by eventmanager
    */

    const EVENT_CREATE_CUSTOMER         = 'create.customer';
    const EVENT_CREATE_CUSTOMER_ERROR   = 'create.customer.error';
    const EVENT_CREATE_CUSTOMER_SUCCESS = 'create.customer.success';

    const EVENT_UPDATE_CUSTOMER         = 'update.customer';
    const EVENT_UPDATE_CUSTOMER_ERROR   = 'update.customer.error';
    const EVENT_UPDATE_CUSTOMER_SUCCESS = 'update.customer.success';

    const EVENT_DELETE_CUSTOMER         = 'delete.customer';
    const EVENT_DELETE_CUSTOMER_ERROR   = 'delete.customer.error';
    const EVENT_DELETE_CUSTOMER_SUCCESS = 'delete.customer.success';

    /**#@-*/

    /**
     * @var CustomerEntity
     */
    protected $customerEntity;

    /**
     * @var Zend\InputFilter\InputFilterInterface
     */
    protected $inputFilter;

    /**
     * @var \Exception
     */
    protected $exception;

    protected $updateData;

    /**
     * @return the $inputFilter
     */
    public function getInputFilter()
    {
        return $this->inputFilter;
    }

    /**
     * @param Zend\InputFilter\InputFilterInterface $inputFilter
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        $this->inputFilter = $inputFilter;
    }

    /**
     * @return the $exception
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * @param Exception $exception
     */
    public function setException(Exception $exception)
    {
        $this->exception = $exception;
    }

    /**
     * Get the value of updateData
     */ 
    public function getUpdateData()
    {
        return $this->updateData;
    }

    /**
     * Set the value of updateData
     *
     * @return  self
     */ 
    public function setUpdateData($updateData)
    {
        $this->updateData = $updateData;

        return $this;
    }

    /**
     * Get the value of customerEntity
     *
     * @return  CustomerEntity
     */ 
    public function getCustomerEntity()
    {
        return $this->customerEntity;
    }

    /**
     * Set the value of customerEntity
     *
     * @param  CustomerEntity  $customerEntity
     *
     * @return  self
     */ 
    public function setCustomerEntity(CustomerEntity $customerEntity)
    {
        $this->customerEntity = $customerEntity;

        return $this;
    }
}
