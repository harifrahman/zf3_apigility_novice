<?php
namespace Usage\V1\Service;

use Usage\Entity\Usage as UsageEntity;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\InputFilter\InputFilter as ZendInputFilter;
use Usage\V1\UsageEvent;

class Usage
{
    use EventManagerAwareTrait;

    protected $usageEvent;
    protected $config;

    public function save(ZendInputFilter $inputFilter)
    {
        $usageEvent = new UsageEvent();
        $usageEvent->setInputFilter($inputFilter);
        $usageEvent->setName(UsageEvent::EVENT_CREATE_USAGE);
        $create = $this->getEventManager()->triggerEvent($usageEvent);
        if ($create->stopped()) {
            $usageEvent->setName(UsageEvent::EVENT_CREATE_USAGE_ERROR);
            $usageEvent->setException($create->last());
            $this->getEventManager()->triggerEvent($usageEvent);
            throw $usageEvent->getException();
        } else {
            $usageEvent->setName(UsageEvent::EVENT_CREATE_USAGE_SUCCESS);
            $this->getEventManager()->triggerEvent($usageEvent);
            return $usageEvent->getUsageEntity();
        }
    }

    /**
     * Update Usage
     *
     * @param \Usage\Entity\Usage  $usage
     * @param array                     $updateData
     */
    public function update($usage, $inputFilter)
    {
        $usageEvent = $this->getUsageEvent();
        $usageEvent->setUsageEntity($usage);

        $usageEvent->setUpdateData($inputFilter->getValues());
        $usageEvent->setInputFilter($inputFilter);
        $usageEvent->setName(UsageEvent::EVENT_UPDATE_USAGE);

        $update = $this->getEventManager()->triggerEvent($usageEvent);
        if ($update->stopped()) {
            $usageEvent->setName(UsageEvent::EVENT_UPDATE_USAGE_ERROR);
            $usageEvent->setException($update->last());
            $this->getEventManager()->triggerEvent($usageEvent);
            throw $usageEvent->getException();
        } else {
            $usageEvent->setName(UsageEvent::EVENT_UPDATE_USAGE_SUCCESS);
            $this->getEventManager()->triggerEvent($usageEvent);
            return $usageEvent->getUsageEntity();
        }
    }

    public function delete(UsageEntity $deletedData)
    {
        $usageEvent = new UsageEvent();
        $usageEvent->setUpdateData($deletedData);
        $usageEvent->setName(UsageEvent::EVENT_DELETE_USAGE);
        $create = $this->getEventManager()->triggerEvent($usageEvent);
        if ($create->stopped()) {
            $usageEvent->setName(UsageEvent::EVENT_DELETE_USAGE_ERROR);
            $usageEvent->setException($create->last());
            $this->getEventManager()->triggerEvent($usageEvent);
            throw $usageEvent->getException();
        } else {
            $usageEvent->setName(UsageEvent::EVENT_DELETE_USAGE_SUCCESS);
            $this->getEventManager()->triggerEvent($usageEvent);
            return true;
        }
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     *
     * @return self
     */
    public function setConfig($config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Get the value of usageEvent
     */
    public function getUsageEvent()
    {
        if ($this->usageEvent == null) {
            $this->usageEvent = new UsageEvent();
        }

        return $this->usageEvent;
    }

    /**
     * Set the value of usageEvent
     *
     * @return  self
     */
    public function setUsageEvent($usageEvent)
    {
        $this->usageEvent = $usageEvent;

        return $this;
    }
}
