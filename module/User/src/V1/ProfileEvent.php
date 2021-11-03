<?php

namespace User\V1;

use Zend\EventManager\Event;
use Aqilix\ORM\Entity\EntityInterface;
use Zend\InputFilter\InputFilterInterface;
use \Exception;

class ProfileEvent extends Event
{
    /**#@+
     * Profile events triggered by eventmanager
     */
    const EVENT_CREATE_PROFILE  = 'create.profile';
    const EVENT_CREATE_PROFILE_ERROR   = 'create.profile.error';
    const EVENT_CREATE_PROFILE_SUCCESS = 'create.profile.success';

    const EVENT_UPDATE_PROFILE  = 'update.profile';
    const EVENT_UPDATE_PROFILE_ERROR   = 'update.profile.error';
    const EVENT_UPDATE_PROFILE_SUCCESS = 'update.profile.success';

    const EVENT_DELETE_PROFILE  = 'delete.profile';
    const EVENT_DELETE_PROFILE_ERROR   = 'delete.profile.error';
    const EVENT_DELETE_PROFILE_SUCCESS = 'delete.profile.success';
    /**#@-*/

    /**
     * @var User\Entity\UserProfile
     */
    protected $userProfileEntity;

    /**
     * @var Zend\InputFilter\InputFilterInterface
     */
    protected $inputFilter;

    /**
     * @var array
     */
    protected $updateData;

    /**
     * @var \Exception
     */
    protected $exception;

    /**
     * @return the $updateData
     */
    public function getUpdateData()
    {
        return $this->updateData;
    }

    /**
     * @param object $updateData
     */
    public function setUpdateData($updateData)
    {
        $this->updateData = $updateData;
    }

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
     * Get the value of userProfileEntity
     *
     * @return  User\Entity\UserProfile
     */ 
    public function getUserProfileEntity()
    {
        return $this->userProfileEntity;
    }

    /**
     * Set the value of userProfileEntity
     *
     * @param  User\Entity\UserProfile  $userProfileEntity
     *
     * @return  self
     */ 
    public function setUserProfileEntity(\User\Entity\UserProfile $userProfileEntity)
    {
        $this->userProfileEntity = $userProfileEntity;

        return $this;
    }
}
