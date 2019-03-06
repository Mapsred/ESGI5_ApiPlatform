<?php

namespace App\Repository;

use App\Entity\PassengerPlaceCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PassengerPlaceCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method PassengerPlaceCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method PassengerPlaceCategory[]    findAll()
 * @method PassengerPlaceCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PassengerPlaceCategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PassengerPlaceCategory::class);
    }

    // /**
    //  * @return PassengerPlaceCategory[] Returns an array of PassengerPlaceCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PassengerPlaceCategory
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
