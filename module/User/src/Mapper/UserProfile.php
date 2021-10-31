<?php

namespace User\Mapper;

use Aqilix\ORM\Mapper\AbstractMapper;
use Aqilix\ORM\Mapper\MapperInterface;

/**
 * @author Dolly Aswin <dolly.aswin@gmail.com>
 *
 * UserProfile Mapper
 */
class UserProfile extends AbstractMapper implements MapperInterface
{
    /**
     * Get Entity Repository
     */
    public function getEntityRepository()
    {
        return $this->getEntityManager()->getRepository('User\\Entity\\UserProfile');
    }

    public function fetchAll(array $params, $order = null, $asc = false)
    {
        $qb = $this->getEntityRepository()->createQueryBuilder('t');

        // filter by search_employee
        if (isset($params['search_employee']) && $params['search_employee'] != '') {
            $searchEmployee = '%'.$params['search_employee'].'%';
            $qb->andWhere('t.firstName like :search_employee')
               ->orWhere('t.lastName like :search_employee')
               ->setParameter('search_employee', $searchEmployee);
        }

        // filter by address
        if (isset($params['address'])) {
            $qb->andWhere('t.address LIKE :address')
            ->setParameter('address', '%'.$params['address'].'%');
        }

        // filter by email
        if (isset($params['email'])) {
            $qb->andWhere('t.email = :email')
            ->setParameter('email', $params['email']);
        }

        // filter username fix
        if (isset($params['username'])) {
            $qb->andWhere('t.username = :username')
            ->setParameter('username', $params['username']);
        }

        // filter by active
        if (isset($params['active'])) {
            $qb->andWhere('t.isActive = :active')
            ->setParameter('active', $params['active']);
        }

        $sort = ($asc == 0) ? 'DESC' : 'ASC';
        if (is_null($order)) {
            $qb->orderBy('t.createdAt', $sort);
        } else {
            $qb->orderBy('t.' . $order, $sort);
        }

        $query = $qb->getQuery();
        $query->useQueryCache(true);
        $query->useResultCache(true, 600);
        return $query;
    }
}
