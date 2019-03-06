<?php

namespace App\Repository;

use App\Entity\PassengerSlot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PassengerSlot|null find($id, $lockMode = null, $lockVersion = null)
 * @method PassengerSlot|null findOneBy(array $criteria, array $orderBy = null)
 * @method PassengerSlot[]    findAll()
 * @method PassengerSlot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PassengerSlotRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PassengerSlot::class);
    }

    // /**
    //  * @return PassengerSlot[] Returns an array of PassengerSlot objects
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
    public function findOneBySomeField($value): ?PassengerSlot
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
