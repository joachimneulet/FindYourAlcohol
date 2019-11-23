<?php

namespace App\Repository;

use App\Entity\Alcool;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Alcool|null find($id, $lockMode = null, $lockVersion = null)
 * @method Alcool|null findOneBy(array $criteria, array $orderBy = null)
 * @method Alcool[]    findAll()
 * @method Alcool[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlcoolRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Alcool::class);
    }

    // /**
    //  * @return Alcool[] Returns an array of Alcool objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Alcool
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
