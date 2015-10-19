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
                ->where('o.status = :status')
                ->setParameter('status', $status);
        } elseif (is_array($status)) {
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
}
