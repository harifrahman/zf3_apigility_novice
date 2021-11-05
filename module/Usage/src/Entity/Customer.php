<?php

namespace Usage\Entity;

use Aqilix\ORM\Entity\EntityInterface;

/**
 * Customer
 */
class Customer implements EntityInterface
{
    /**
     * @var string
     */
    private $uuid;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string|null
     */
    private $lastName;

    /**
     * @var string|null
     */
    private $email;

    /**
     * @var string|null
     */
    private $address;

    /**
     * @var int
     */
    private $isActive = 1;

    /**
     * @var string|null
     */
    private $customerId;

    /**
     * @var string|null
     */
    private $waterMeterId;

    /**
     * @var int
     */
    private $lastStandMeter;

    /**
     * @var \DateTime|null
     */
    private $lastStandMeterUpdate;    
    
    /**
     * @var string|null
     */
    private $postalCode;


    /**
     * @var \DateTime|null
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     */
    private $updatedAt;

    /**
     * @var \DateTime|null
     */
    private $deletedAt;

    /**
     * Set updatedAt.
     *
     * @param \DateTime|null $updatedAt
     *
     * @return DeviceFunction
     */
    public function setUpdatedAt($updatedAt = null)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return \DateTime|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set deletedAt.
     *
     * @param \DateTime|null $deletedAt
     *
     * @return DeviceFunction
     */
    public function setDeletedAt($deletedAt = null)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt.
     *
     * @return \DateTime|null
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Get uuid.
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Get the value of firstName
     *
     * @return  string
     */ 
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @param  string  $firstName
     *
     * @return  self
     */ 
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of lastName
     *
     * @return  string|null
     */ 
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @param  string|null  $lastName
     *
     * @return  self
     */ 
    public function setLastName($lastName = null)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  string|null
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string|null  $email
     *
     * @return  self
     */ 
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of address
     *
     * @return  string|null
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @param  string|null  $address
     *
     * @return  self
     */ 
    public function setAddress($address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of isActive
     *
     * @return  int
     */ 
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set the value of isActive
     *
     * @param  int  $isActive
     *
     * @return  self
     */ 
    public function setIsActive(int $isActive = 1)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get the value of customerId
     *
     * @return  string|null
     */ 
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set the value of customerId
     *
     * @param  string|null  $customerId
     *
     * @return  self
     */ 
    public function setCustomerId($customerId = null)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Get the value of waterMeterId
     *
     * @return  string|null
     */ 
    public function getWaterMeterId()
    {
        return $this->waterMeterId;
    }

    /**
     * Set the value of waterMeterId
     *
     * @param  string|null  $waterMeterId
     *
     * @return  self
     */ 
    public function setWaterMeterId($waterMeterId = null)
    {
        $this->waterMeterId = $waterMeterId;

        return $this;
    }

    /**
     * Get the value of lastStandMeter
     *
     * @return  int|null
     */ 
    public function getLastStandMeter()
    {
        return $this->lastStandMeter;
    }

    /**
     * Set the value of lastStandMeter
     *
     * @param  int|null  $lastStandMeter
     *
     * @return  self
     */ 
    public function setLastStandMeter(int $lastStandMeter = null)
    {
        $this->lastStandMeter = $lastStandMeter;

        return $this;
    }

    /**
     * Get the value of lastStandMeterUpdate
     *
     * @return  \DateTime|null
     */ 
    public function getLastStandMeterUpdate()
    {
        return $this->lastStandMeterUpdate;
    }

    /**
     * Set the value of lastStandMeterUpdate
     *
     * @param  \DateTime|null  $lastStandMeterUpdate
     *
     * @return  self
     */ 
    public function setLastStandMeterUpdate($lastStandMeterUpdate = null)
    {
        $this->lastStandMeterUpdate = $lastStandMeterUpdate;

        return $this;
    }

    /**
     * Get the value of postalCode
     *
     * @return  string|null
     */ 
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set the value of postalCode
     *
     * @param  string|null  $postalCode
     *
     * @return  self
     */ 
    public function setPostalCode($postalCode = null)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get the value of createdAt
     *
     * @return  \DateTime|null
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @param  \DateTime|null  $createdAt
     *
     * @return  self
     */ 
    public function setCreatedAt($createdAt = null)
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
