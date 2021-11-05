<?php

namespace Usage\Mapper;

use Aqilix\ORM\Mapper\AbstractMapper;
use Aqilix\ORM\Mapper\MapperInterface;

/**
 * @author Arif Rahman Hakim <harifrahman999@gmail.com>
 *
 * Usage Mapper
 */
class Usage extends AbstractMapper implements MapperInterface
{

    /**
     * Get Entity Repository
     */
    public function getEntityRepository()
    {
        return $this->getEntityManager()->getRepository('Usage\\Entity\\Usage');
    }

    /**
     * Fetch All from Customer Data
     *
     * @param array $params
     * @return Doctrine\ORM\Query
     */
    public function fetchAll(array $params, $order = null, $asc = false)
    {
        $qb = $this->getEntityRepository()->createQueryBuilder('t');
        $cacheKey = 'usage_';

        // if (isset($params['search'])) {
        //     $qb->andWhere('t.firstName LIKE :search OR t.lastName LIKE :search')
        //        ->setParameter('search', '%' . $params['search'] . '%');
        //     $cacheKey .= '_' . $params['search'];
        // }

        if (isset($params['user_profile_uuid'])) {
            $qb->andWhere('t.userProfile = :user_profile_uuid')
               ->setParameter('user_profile_uuid', $params['user_profile_uuid']);
            $cacheKey .= '_' . $params['user_profile_uuid'];
        }

        if (isset($params['customer'])) {
            $qb->andWhere('t.customer = :customer')
               ->setParameter('customer', $params['customer']);
            $cacheKey .= '_' . $params['customer'];
        }

        $sort = ($asc == false) ? 'DESC' : 'ASC';
        if (is_null($order)) {
            $qb->orderBy('t.createdAt', $sort);
        } else {
            $qb->orderBy('t.' . $order, $sort);
        }

        $query = $qb->getQuery();
        $query->useQueryCache(true);
        $query->useResultCache(true, 600, $cacheKey);
        return $query;
    }
}
