<?php

namespace App\Repository;

use App\Entity\CopyBook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CopyBook|null find($id, $lockMode = null, $lockVersion = null)
 * @method CopyBook|null findOneBy(array $criteria, array $orderBy = null)
 * @method CopyBook[]    findAll()
 * @method CopyBook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CopyBookRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CopyBook::class);
    }

    // /**
    //  * @return CopyBook[] Returns an array of CopyBook objects
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
    public function findOneBySomeField($value): ?CopyBook
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
