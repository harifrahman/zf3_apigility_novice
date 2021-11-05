<?php

namespace Usage\V1;

use Zend\EventManager\Event;
use Zend\InputFilter\InputFilterInterface;
use \Exception;
use Usage\Entity\Usage as UsageEntity;

class UsageEvent extends Event
{
    /**#@+
    * Usage events triggered by eventmanager
    */

    const EVENT_CREATE_USAGE         = 'create.usage';
    const EVENT_CREATE_USAGE_ERROR   = 'create.usage.error';
    const EVENT_CREATE_USAGE_SUCCESS = 'create.usage.success';

    const EVENT_UPDATE_USAGE         = 'update.usage';
    const EVENT_UPDATE_USAGE_ERROR   = 'update.usage.error';
    const EVENT_UPDATE_USAGE_SUCCESS = 'update.usage.success';

    const EVENT_DELETE_USAGE         = 'delete.usage';
    const EVENT_DELETE_USAGE_ERROR   = 'delete.usage.error';
    const EVENT_DELETE_USAGE_SUCCESS = 'delete.usage.success';

    /**#@-*/

    /**
     * @var UsageEntity
     */
    protected $usageEntity;

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
     * Get the value of usageEntity
     *
     * @return  UsageEntity
     */ 
    public function getUsageEntity()
    {
        return $this->usageEntity;
    }

    /**
     * Set the value of usageEntity
     *
     * @param  UsageEntity  $usageEntity
     *
     * @return  self
     */ 
    public function setUsageEntity(UsageEntity $usageEntity)
    {
        $this->usageEntity = $usageEntity;

        return $this;
    }
}
