<?php

namespace App\Utils;

use App\Entity\Airplane;
use App\Entity\AirplanePlace;
use App\Entity\Flight;
use App\Entity\Ticket;
use App\Entity\Passenger;
use App\Exception\FlightNotFoundException;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class TicketBuilder
 * @package App\Utils
 */
class PassengerBuilder
{
    /**
     * Coefficient to calculate the ticket place by considering place rank (rank*coef)
     */
    const PRICE_CATEGORY_PLACE_COEF = 10;

    /**
     * @var EntityManagerInterface $manager
     */
    private $manager;

    /**
     * TicketBuilder constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param Passenger $passenger
     * @throws FlightNotFoundException
     */
    public function build(Passenger $passenger)
    {
        $this->createAndAssignTicket($passenger);
        $this->manager->flush();
    }

    /**
     * @param Passenger $passenger
     * @throws FlightNotFoundException
     */
    private function createAndAssignTicket(Passenger $passenger)
    {
        $ticket = new Ticket();
        $ticket->setPassenger($passenger);
        /**
         * @var Airplane $airplane
         */
        $flight = $this->findOneFlight();

        $airplanePlaces = $flight->getAirplanePlaces()->toArray();
        /**
         * @var AirplanePlace $place
         */
        foreach ($airplanePlaces as $place) {
            if(is_null($place->getTicket())){
                $place->setTicket($ticket);
                $price = $place->getPlaceCategory()->getRank() * self::PRICE_CATEGORY_PLACE_COEF;
                $ticket->setPrice($price);
                break;
            }
        }

        $this->manager->persist($ticket);
    }

    private function findOneFlight(): Flight
    {
        $flights = $this->manager->getRepository(Flight::class)->findAll();

        if (empty($flights)) {
            throw new FlightNotFoundException('No flight has been created.');
        }

        /**
         * @var Airplane $flight
         */
        foreach ($flights as $key => $flight) {
            if (!$this->hasFreePlace($flight)) {
                unset($flights[$key]);
            }
        }

        if (empty($flights)) {
            throw new FlightNotFoundException('No flight has free place.');
        }

        $randKey = array_rand($flights);

        /**
         * @var Airplane $airplane
         */
        return $flights[$randKey];

    }

    /**
     * Check if there is at least one free place for a flight
     * @param Flight $flight
     * @return bool
     */
    private function hasFreePlace(Flight $flight): bool
    {
        $places = $flight->getAirplanePlaces();

        if (!empty($places)) {
            /**
             * AirplanePlace $places
             */
            foreach ($places as $place) {
                $ticket = $place->getTicket();
                if (is_null($ticket)) {
                    return true;
                }
            }
        }
        return false;
    }
}
