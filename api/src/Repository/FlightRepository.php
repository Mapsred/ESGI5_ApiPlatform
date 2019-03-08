<?php

namespace App\Repository;

use App\Entity\Flight;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Flight|null find($id, $lockMode = null, $lockVersion = null)
 * @method Flight|null findOneBy(array $criteria, array $orderBy = null)
 * @method Flight[]    findAll()
 * @method Flight[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlightRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Flight::class);
    }

    public function findConcurrentFlight(Flight $flight)
    {
        $parameters = [
            'departure_date' => $flight->getDepartureDate(),
            'arrival_date' => $flight->getArrivalDate(),
            'airplane' => $flight->getAirplane()
        ];

        $qb = $this->createQueryBuilder('q')
            ->select('COUNT(q.id)')
            ->where('q.airplane = :airplane');

        if ($flight->getId()) {
            $parameters['id'] = $flight->getId();
            $qb->andWhere('q.id != :id');
        }

        $qb->andWhere(
            $qb->expr()->orX(
                $qb->expr()->andX(
                    $qb->expr()->gte('q.departureDate', ':departure_date'),
                    $qb->expr()->lte('q.arrivalDate', ':arrival_date')
                ),

                $qb->expr()->andX(
                    $qb->expr()->lte('q.departureDate', ':departure_date'),
                    $qb->expr()->gte('q.arrivalDate', ':departure_date')
                ),

                $qb->expr()->andX(
                    $qb->expr()->lte('q.departureDate', ':arrival_date'),
                    $qb->expr()->gte('q.arrivalDate', ':arrival_date')
                )
            )
        )->setParameters($parameters);

        return $qb
            ->getQuery()
            ->getSingleScalarResult();
    }
}
