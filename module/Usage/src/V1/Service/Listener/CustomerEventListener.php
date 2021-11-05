<?php
namespace Usage\V1\Service\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Exception\InvalidArgumentException;
use Psr\Log\LoggerAwareTrait;
use Usage\Mapper\CustomerTrait as CustomerMapperTrait;
use Usage\Entity\Customer as CustomerEntity;
use Zend\EventManager\EventManagerAwareTrait;
use Usage\V1\CustomerEvent;
use Zend\Log\Exception\RuntimeException;

class CustomerEventListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;
    use EventManagerAwareTrait;
    use LoggerAwareTrait;
    use CustomerMapperTrait;

    protected $customerEvent;
    protected $customerHydrator;

    public function __construct(
        \Usage\Mapper\Customer $customerMapper
    ) {
        $this->setCustomerMapper($customerMapper);
    }

    /**
     * (non-PHPdoc)
     * @see \Zend\EventManager\ListenerAggregateInterface::attach()
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(
            CustomerEvent::EVENT_CREATE_CUSTOMER,
            [$this, 'createCustomer'],
            500
        );

        $this->listeners[] = $events->attach(
            CustomerEvent::EVENT_UPDATE_CUSTOMER,
            [$this, 'updateCustomer'],
            500
        );

        $this->listeners[] = $events->attach(
            CustomerEvent::EVENT_DELETE_CUSTOMER,
            [$this, 'deleteCustomer'],
            500
        );
    }

    public function createCustomer(CustomerEvent $event)
    {
        try {
            if (! $event->getInputFilter() instanceof InputFilterInterface) {
                throw new InvalidArgumentException('Input Filter not set');
            }

            $bodyRequest = $event->getInputFilter()->getValues();
            $customerEntity = new CustomerEntity;
            $hydrateEntity  = $this->getCustomerHydrator()->hydrate($bodyRequest, $customerEntity);
            $entityResult   = $this->getCustomerMapper()->save($hydrateEntity);
            $event->setCustomerEntity($entityResult);
        } catch (RuntimeException $e) {
            $event->stopPropagation(true);
            return $e;
        }
    }

    public function updateCustomer(CustomerEvent $event)
    {
        try {
            $customerEntity = $event->getCustomerEntity();
            $customerEntity->setUpdatedAt(new \DateTime('now'));
            $updateData  = $event->getUpdateData();

            if (! $event->getInputFilter() instanceof InputFilterInterface) {
                throw new InvalidArgumentException('Input Filter not set');
            }

            $customer = $this->getCustomerHydrator()->hydrate($updateData, $customerEntity);

            $entityResult = $this->getCustomerMapper()->save($customer);
            $event->setCustomerEntity($entityResult);
        } catch (\Exception $e) {
            $event->stopPropagation(true);
            return $e;
        }
    }

    public function deleteCustomer(CustomerEvent $event)
    {
        try {
            $deletedData = $event->getUpdateData();
            $result = $this ->getCustomerMapper()->delete($deletedData);
        } catch (\Exception $e) {
            $this->logger->log(\Psr\Log\LogLevel::ERROR, "{function} : Something Error! \nError_message: ".$e->getMessage(), ["function" => __FUNCTION__]);
        }
    }

    /**
     * Get the value of customerHydrator
     */
    public function getCustomerHydrator()
    {
        return $this->customerHydrator;
    }

    /**
     * Set the value of customerHydrator
     *
     * @return  self
     */
    public function setCustomerHydrator($customerHydrator)
    {
        $this->customerHydrator = $customerHydrator;

        return $this;
    }
}
