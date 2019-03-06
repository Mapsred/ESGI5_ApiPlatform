<?php

namespace App\Repository;

use App\Entity\PassengerPlace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PassengerPlace|null find($id, $lockMode = null, $lockVersion = null)
 * @method PassengerPlace|null findOneBy(array $criteria, array $orderBy = null)
 * @method PassengerPlace[]    findAll()
 * @method PassengerPlace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PassengerPlaceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PassengerPlace::class);
    }

    // /**
    //  * @return PassengerPlace[] Returns an array of PassengerPlace objects
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
    public function findOneBySomeField($value): ?PassengerPlace
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
