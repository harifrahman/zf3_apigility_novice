<?php

namespace Usage\Mapper;

use Aqilix\ORM\Mapper\AbstractMapper;
use Aqilix\ORM\Mapper\MapperInterface;

/**
 * @author Arif Rahman Hakim <harifrahman999@gmail.com>
 *
 * Customer Mapper
 */
class Customer extends AbstractMapper implements MapperInterface
{

    /**
     * Get Entity Repository
     */
    public function getEntityRepository()
    {
        return $this->getEntityManager()->getRepository('Usage\\Entity\\Customer');
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
        $cacheKey = 'customer_';

        if (isset($params['search'])) {
            $qb->andWhere('t.firstName LIKE :search OR t.lastName LIKE :search')
               ->setParameter('search', '%' . $params['search'] . '%');
            $cacheKey .= '_' . $params['search'];
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
