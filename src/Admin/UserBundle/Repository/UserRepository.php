<?php

namespace Admin\UserBundle\Repository;

/**
 * UserRepository
 *
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Count all enabled User
     *
     * @return int
     */
    public function countAll()
    {
        $qb = $this->createQueryBuilder('u')
            ->select('count(u.id)')
            ->where('u.enabled = :isEnabled')
            ->setParameter('isEnabled', true);

        return $qb->getQuery()->getSingleScalarResult();
    }
}
