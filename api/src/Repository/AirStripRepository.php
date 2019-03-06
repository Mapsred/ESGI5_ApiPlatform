<?php

namespace App\Repository;

use App\Entity\AirStrip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AirStrip|null find($id, $lockMode = null, $lockVersion = null)
 * @method AirStrip|null findOneBy(array $criteria, array $orderBy = null)
 * @method AirStrip[]    findAll()
 * @method AirStrip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AirStripRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AirStrip::class);
    }

    // /**
    //  * @return AirStrip[] Returns an array of AirStrip objects
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
    public function findOneBySomeField($value): ?AirStrip
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
