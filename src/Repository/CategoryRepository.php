<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function getAlcoolFromCategory($id){
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
        SELECT * FROM Alcool a
        WHERE a.category = :id
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    /**
     * @param $id
     * @return Cocktails in the category from it's ID
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getCoktailFromCategory($id){
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
        SELECT libelle FROM Category c
        WHERE c.id = :id
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $libelle = $stmt->fetch();
        $json = file_get_contents('https://www.thecocktaildb.com/api/json/v1/1/filter.php?i='.$libelle['libelle']);
        $obj = json_decode($json);
        return $obj->drinks;
    }



    // /**
    //  * @return Category[] Returns an array of Category objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Category
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
