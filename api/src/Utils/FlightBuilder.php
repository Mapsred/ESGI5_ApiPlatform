<?php

namespace App\Utils;

use App\Entity\AirplanePlace;
use App\Entity\Flight;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class FlightBuilder
 * @package App\Utils
 */
class FlightBuilder
{
    /**
     * @var EntityManagerInterface $manager
     */
    private $manager;

    /**
     * AirplaneBuilder constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param Flight $flight
     */
    public function build(Flight $flight)
    {
        $this->buildAirplanePlaces($flight);
        $this->manager->flush();
    }

    private function buildAirplanePlaces(Flight $flight)
    {
        $modelPlaceCategories = $flight->getAirplane()->getAirplaneModel()->getAirplaneModelPlaceCategories();
        foreach ($modelPlaceCategories as $modelPlaceCategory) {
            for ($i = 0; $i < $modelPlaceCategory->getNumber(); $i++) {
                $name = sprintf("Place %s Category %s", $i, $modelPlaceCategory->getPlaceCategory()->getRank());

                $airplanePlace = new AirplanePlace();
                $airplanePlace
                    ->setFlight($flight)
                    ->setName($name)
                    ->setPlaceCategory($modelPlaceCategory->getPlaceCategory());

                $this->manager->persist($airplanePlace);
            }
        }
    }

}
