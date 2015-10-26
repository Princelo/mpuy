<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends EntityRepository
{
    public function getLikedProducts($user, $limit)
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('p')
            ->from('AppBundle:Product', 'p')
            ->innerJoin('p.likeUsers', 'u')
            ->where('u.id = :user_id' )
            ->setParameter('user_id', $user->getId() )
            ->getQuery()
            ->setMaxResults($limit)
            ->getResult();
    }

    public function getRandomProduct($category)
    {
        $now = new \DateTime();
        $count = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('COUNT(p)')
            ->from('AppBundle:Product', 'p')
            ->where('p.category = :category')
            ->andWhere('p.expireTime > :now')
            ->setParameter('category', $category)
            ->setParameter('now', $now)
            ->getQuery()
            ->getSingleScalarResult();
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('p')
            ->from('AppBundle:Product', 'p')
            ->where('p.category = :category')
            ->andWhere('p.expireTime > :now')
            ->setFirstResult(rand(0, $count - 1))
            ->setMaxResults(1)
            ->setParameter('category', $category)
            ->setParameter('now', $now)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getHomeProducts($user, $offset = 0, $count = 5)
    {
        $this->getEntityManager()
            ->createQueryBuilder()
            ->select('p')
            ->from('AppBundle:Product', 'p')
            //->join('AcmeAccountBundle:User', 'u', 'WITH', 'u = :user')
            //->where('p.user MEMBER OF u.followedUsers')
            //->where('p.isActive = TRUE')
            //->setFirstResult($offset)
            //->setMaxResults($count)
            //->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }
}
