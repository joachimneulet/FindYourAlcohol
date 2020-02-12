<?php

namespace App\Repository;

use App\Entity\Cocktail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Cocktail|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cocktail|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cocktail[]    findAll()
 * @method Cocktail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CocktailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cocktail::class);
    }

    public function getCoktailDetailsFromId($id){

        $json = file_get_contents('https://www.thecocktaildb.com/api/json/v1/1/lookup.php?i='.$id);
        $obj = json_decode($json);
        return $obj;
    }

    public function getCoktailDetailsFromName($name){

        $json = file_get_contents('https://www.thecocktaildb.com/api/json/v1/1/search.php?i='.$name);
        $obj = json_decode($json);
        return $obj;
    }

    public function getCoktailFromIngredient($name){

        $json = file_get_contents('https://www.thecocktaildb.com/api/json/v1/1/filter.php?i='.$name);
        $obj = json_decode($json);
        return $obj->drinks;
    }

    public function getIngredients(){
        $json = file_get_contents('https://www.thecocktaildb.com/api/json/v1/1/list.php?i=list');
        $obj = json_decode($json);
        return $obj->drinks;
    }

    public function getIngredientIDfromName($name){
        $nameURL = str_replace(" ", "%20", $name);
        $json = file_get_contents('https://www.thecocktaildb.com/api/json/v1/1/search.php?i='.$nameURL);
        $obj = json_decode($json);
        return $obj->ingredients;
    }

    // /**
    //  * @return Cocktail[] Returns an array of Cocktail objects
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
    public function findOneBySomeField($value): ?Cocktail
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
