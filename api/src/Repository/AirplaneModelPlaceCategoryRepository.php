<?php

namespace App\Repository;

use App\Entity\AirplaneModelPlaceCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AirplaneModelPlaceCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method AirplaneModelPlaceCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method AirplaneModelPlaceCategory[]    findAll()
 * @method AirplaneModelPlaceCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AirplaneModelPlaceCategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AirplaneModelPlaceCategory::class);
    }

    // /**
    //  * @return AirplaneModelPlaceCategory[] Returns an array of AirplaneModelPlaceCategory objects
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
    public function findOneBySomeField($value): ?AirplaneModelPlaceCategory
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
