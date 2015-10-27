<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PaymentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PaymentRepository extends EntityRepository
{
    public function getHighestPayment($product)
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('p')
            ->from('AppBundle:Payment', 'p')
            ->innerJoin('p.product', 'pr')
            ->where('pr = :pr' )
            ->setParameter('pr', $product )
            ->addOrderBy('p.id DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getBidList($product)
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('p.volume, p.payTime as datetime, u.nickname, u.avatar')
            ->from('AppBundle:Payment', 'p')
            ->innerJoin('p.product', 'pr')
            ->innerJoin('p.payUser', 'u')
            ->where('pr = :pr' )
            ->setParameter('pr', $product )
            ->addOrderBy('p.id DESC')
            ->getQuery()
            ->getResult();
    }
}
