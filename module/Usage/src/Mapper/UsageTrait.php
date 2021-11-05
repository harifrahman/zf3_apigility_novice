<?php

namespace Usage\Mapper;

/**
 * @author Arif Rahman Hakim <harifrahman999@gmail.com>
 *
 * Usage Trait
 */
trait UsageTrait
{
    /**
     * @var \Usage\Mapper\Usage
     */
    protected $usageMapper;

    /**
     * Get the value of usageMapper
     *
     * @return  \Usage\Mapper\Usage
     */ 
    public function getUsageMapper()
    {
        return $this->usageMapper;
    }

    /**
     * Set the value of usageMapper
     *
     * @param  \Usage\Mapper\Usage  $usageMapper
     *
     * @return  self
     */ 
    public function setUsageMapper(\Usage\Mapper\Usage $usageMapper)
    {
        $this->usageMapper = $usageMapper;

        return $this;
    }
}
