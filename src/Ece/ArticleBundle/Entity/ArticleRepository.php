<?php

namespace Ece\ArticleBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{

    public function findAccueil()
    {
        $qb = $this->createQueryBuilder('a')
            ->addSelect('c')
            ->join('a.categorie', 'c')
            ->addOrderBy('a.date', 'DESC')
            ->setMaxResults(10)
        ;

        return $qb->getQuery()->execute();
    }

}
