<?php

namespace Usage\V1\Hydrator\Strategy;

use Zend\Hydrator\Strategy\StrategyInterface;
use Usage\Entity\Customer as CustomerEntity;

/**
 * Class CustomerStrategy
 */
class CustomerStrategy implements StrategyInterface
{
    /**
     * Converts the given value so that it can be extracted by the hydrator.
     *
     * @param  mixed $value The original value.
     * @param  object $object (optional) The original object for context.
     * @return mixed Returns the value that should be extracted.
     * @throws \RuntimeException If object os not a User
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function extract($value, $object = null)
    {
        if ($value instanceof CustomerEntity && ! is_null($value)) {
            $lastStandMeterUpdate = is_null($value->getLastStandMeterUpdate()) ? null : $value->getLastStandMeterUpdate()->format('Y-m-d H:i:s');
            $values = [
                "uuid" => $value->getUuid(),
                "firstName" => $value->getFirstName(),
                "lastName" => $value->getLastName(),
                "email" => $value->getEmail(),
                "address" => $value->getAddress(),
                "postalCode" => $value->getPostalCode(),
                "isActive" => $value->getIsActive(),
                "customerId" => $value->getCustomerId(),
                "waterMeterId" => $value->getWaterMeterId(),
                "lastStandMeter" => $value->getWaterMeterId(),
                "lastStandMeterUpdate" => $lastStandMeterUpdate
            ];
            return $values;
        }

        return null;
    }

    /**
     * Converts the given value so that it can be hydrated by the hydrator.
     *
     * @param  mixed $value The original value.
     * @param  array $data (optional) The original data for context.
     * @return mixed Returns the value that should be hydrated.
     * @throws \InvalidArgumentException
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function hydrate($value, array $data = null)
    {
        return $value;
    }
}
