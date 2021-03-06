<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * AuctionOrderRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AuctionOrderRepository extends EntityRepository
{
    public function getOrders($buyer = null, $seller = null, $limit, $offset = 0, $sort = 'id desc', $status = null)
    {
        $prepare = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('o')
            ->from('AppBundle:AuctionOrder', 'o');
        if ( $buyer != null) {
            $prepare = $prepare
                ->where('o.buyer = :buyer')
                ->setParameter('buyer', $buyer);
        }
        if ( $seller != null) {
            $prepare = $prepare
                ->where('o.seller = :seller')
                ->setParameter('seller', $seller);
        }
        if ( $status != null && !is_array($status)) {
            $prepare = $prepare
                ->andWhere('o.status = :status')
                ->setParameter('status', $status);
        } elseif (is_array($status) && count($status) > 1) {
            $prepare = $prepare
                ->andWhere('o.status = '.$status[0].' OR o.status = '.$status[1]);
        }
        $prepare = $prepare
            ->setFirstResult($offset)
            ->setMaxResults($limit);
        return $prepare
            ->getQuery()
            ->getResult();

    }

    public function getQueryOrderList($where)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "
                SELECT o
                 FROM AppBundle:AuctionOrder o
                WHERE 1 = 1
                {$where}
                ORDER BY o.id DESC
            "
            );
        return $query;
    }
}
