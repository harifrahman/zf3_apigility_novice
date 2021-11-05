<?php

namespace Usage\V1\Hydrator\Strategy;

use Zend\Hydrator\Strategy\StrategyInterface;
use User\Entity\UserProfile as UserProfileEntity;

/**
 * Class UserProfileObjectStrategy
 */
class UserProfileObjectStrategy implements StrategyInterface
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
        if ($value instanceof UserProfileEntity && ! is_null($value)) {
            $dob = is_null($value->getDateOfBirth()) ? null : $value->getDateOfBirth()->format('Y-m-d');
            $values = [
                "uuid" => $value->getUuid(),
                "firstName" => $value->getFirstName(),
                "lastName" => $value->getLastName(),
                "dateOfBirth" => $dob,
                "address" => $value->getAddress(),
                "city" => $value->getCity(),
                "province" => $value->getProvince(),
                "postalCode" => $value->getPostalCode(),
                "country" => $value->getCountry()
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
