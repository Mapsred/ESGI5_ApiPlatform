<?php

namespace App\Repository;

use App\Entity\AirplaneModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AirplaneModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method AirplaneModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method AirplaneModel[]    findAll()
 * @method AirplaneModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AirplaneModelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AirplaneModel::class);
    }

    // /**
    //  * @return AirplaneModel[] Returns an array of AirplaneModel objects
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
    public function findOneBySomeField($value): ?AirplaneModel
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
