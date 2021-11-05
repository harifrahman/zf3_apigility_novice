<?php
namespace Usage\V1\Service\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Exception\InvalidArgumentException;
use Psr\Log\LoggerAwareTrait;
use Usage\Mapper\UsageTrait as UsageMapperTrait;
use Usage\Entity\Usage as UsageEntity;
use Zend\EventManager\EventManagerAwareTrait;
use Usage\V1\UsageEvent;
use Zend\Log\Exception\RuntimeException;

class UsageEventListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;
    use EventManagerAwareTrait;
    use LoggerAwareTrait;
    use UsageMapperTrait;

    protected $usageEvent;
    protected $usageHydrator;

    public function __construct(
        \Usage\Mapper\Usage $usageMapper
    ) {
        $this->setUsageMapper($usageMapper);
    }

    /**
     * (non-PHPdoc)
     * @see \Zend\EventManager\ListenerAggregateInterface::attach()
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(
            UsageEvent::EVENT_CREATE_USAGE,
            [$this, 'createUsage'],
            500
        );

        $this->listeners[] = $events->attach(
            UsageEvent::EVENT_UPDATE_USAGE,
            [$this, 'updateUsage'],
            500
        );

        $this->listeners[] = $events->attach(
            UsageEvent::EVENT_DELETE_USAGE,
            [$this, 'deleteUsage'],
            500
        );
    }

    public function createUsage(UsageEvent $event)
    {
        try {
            if (! $event->getInputFilter() instanceof InputFilterInterface) {
                throw new InvalidArgumentException('Input Filter not set');
            }

            $bodyRequest = $event->getInputFilter()->getValues();

            $usageEntity = new UsageEntity;
            $hydrateEntity  = $this->getUsageHydrator()->hydrate($bodyRequest, $usageEntity);
            $entityResult   = $this->getUsageMapper()->save($hydrateEntity);
            $event->setUsageEntity($entityResult);

        } catch (RuntimeException $e) {
            $event->stopPropagation(true);
            return $e;
        }
    }

    public function updateUsage(UsageEvent $event)
    {
        try {
            $usageEntity = $event->getUsageEntity();
            $usageEntity->setUpdatedAt(new \DateTime('now'));
            $updateData  = $event->getUpdateData();

            if (! $event->getInputFilter() instanceof InputFilterInterface) {
                throw new InvalidArgumentException('Input Filter not set');
            }

            $usage = $this->getUsageHydrator()->hydrate($updateData, $usageEntity);

            $entityResult = $this->getUsageMapper()->save($usage);
            $uuid = $entityResult->getUuid();
            $event->setUsageEntity($entityResult);

        } catch (\Exception $e) {
            $event->stopPropagation(true);
            return $e;
        }
    }

    public function deleteUsage(UsageEvent $event)
    {
        try {
            $deletedData = $event->getUpdateData();
            $result = $this ->getUsageMapper()->delete($deletedData);

        } catch (\Exception $e) {
            $this->logger->log(\Psr\Log\LogLevel::ERROR, "{function} : Something Error! \nError_message: ".$e->getMessage(), ["function" => __FUNCTION__]);
        }
    }

    /**
     * Get the value of usageHydrator
     */
    public function getUsageHydrator()
    {
        return $this->usageHydrator;
    }

    /**
     * Set the value of usageHydrator
     *
     * @return  self
     */
    public function setUsageHydrator($usageHydrator)
    {
        $this->usageHydrator = $usageHydrator;

        return $this;
    }
}
