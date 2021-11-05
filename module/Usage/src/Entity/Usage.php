<?php

namespace Usage\Entity;

use Aqilix\ORM\Entity\EntityInterface;

/**
 * Usage
 */
class Usage implements EntityInterface
{
    /**
     * @var string|null
     */
    private $usageId;

    /**
     * @var string|null
     */
    private $path;

    /**
     * @var int|null
     */
    private $month;

    /**
     * @var int|null
     */
    private $year;

    /**
     * @var int|null
     */
    private $lastStandMeter;

    /**
     * @var int|null
     */
    private $currentMeter;

    /**
     * @var int|null
     */
    private $usage;

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
     * @var string
     */
    private $uuid;

    /**
     * @var \User\Entity\UserProfile
     */
    private $userProfile;

    /**
     * @var \Usage\Entity\Customer
     */
    private $customer;

    /**
     * Get the value of uuid
     *
     * @return  string
     */
    public function getUuid()
    {
        return $this->uuid;
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
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of updatedAt
     *
     * @return  \DateTime|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of updatedAt
     *
     * @param  \DateTime|null  $updatedAt
     *
     * @return  self
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get the value of deletedAt
     *
     * @return  \DateTime|null
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set the value of deletedAt
     *
     * @param  \DateTime|null  $deletedAt
     *
     * @return  self
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get the value of usageId
     *
     * @return  string|null
     */ 
    public function getUsageId()
    {
        return $this->usageId;
    }

    /**
     * Set the value of usageId
     *
     * @param  string|null  $usageId
     *
     * @return  self
     */ 
    public function setUsageId($usageId = null)
    {
        $this->usageId = $usageId;

        return $this;
    }

    /**
     * Get the value of path
     *
     * @return  string|null
     */ 
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set the value of path
     *
     * @param  string|null  $path
     *
     * @return  self
     */ 
    public function setPath($path = null)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get the value of month
     *
     * @return  int|null
     */ 
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Set the value of month
     *
     * @param  int|null  $month
     *
     * @return  self
     */ 
    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }

    /**
     * Get the value of year
     *
     * @return  int|null
     */ 
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set the value of year
     *
     * @param  int|null  $year
     *
     * @return  self
     */ 
    public function setYear($year)
    {
        $this->year = $year;

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
    public function setLastStandMeter($lastStandMeter)
    {
        $this->lastStandMeter = $lastStandMeter;

        return $this;
    }

    /**
     * Get the value of currentMeter
     *
     * @return  int|null
     */ 
    public function getCurrentMeter()
    {
        return $this->currentMeter;
    }

    /**
     * Set the value of currentMeter
     *
     * @param  int|null  $currentMeter
     *
     * @return  self
     */ 
    public function setCurrentMeter($currentMeter)
    {
        $this->currentMeter = $currentMeter;

        return $this;
    }

    /**
     * Get the value of usage
     *
     * @return  int|null
     */ 
    public function getUsage()
    {
        return $this->usage;
    }

    /**
     * Set the value of usage
     *
     * @param  int|null  $usage
     *
     * @return  self
     */ 
    public function setUsage($usage)
    {
        $this->usage = $usage;

        return $this;
    }

    /**
     * Get the value of userProfile
     *
     * @return  \User\Entity\UserProfile
     */ 
    public function getUserProfile()
    {
        return $this->userProfile;
    }

    /**
     * Set the value of userProfile
     *
     * @param  \User\Entity\UserProfile  $userProfile
     *
     * @return  self
     */ 
    public function setUserProfile(\User\Entity\UserProfile $userProfile)
    {
        $this->userProfile = $userProfile;

        return $this;
    }

    /**
     * Get the value of customer
     *
     * @return  \Usage\Entity\Customer
     */ 
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set the value of customer
     *
     * @param  \Usage\Entity\Customer  $customer
     *
     * @return  self
     */ 
    public function setCustomer(\Usage\Entity\Customer $customer)
    {
        $this->customer = $customer;

        return $this;
    }
}
