<?php

namespace App\Utils;

use App\Entity\AirplanePlace;
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

        $place = $this->manager->getRepository(AirplanePlace::class)->findOneBy([
            'ticket' => null
        ]);

        if (null === $place) {
            throw new FlightNotFoundException('No place available.');
        }

        if (null === $place->getFlight()) {
            throw new FlightNotFoundException('No flight has been created.');
        }

        $price = $place->getPlaceCategory()->getRank() * self::PRICE_CATEGORY_PLACE_COEF;
        $ticket
            ->setPassenger($passenger)
            ->setPrice($price)
            ->setAirplanePlace($place);

        $this->manager->persist($ticket);
    }
}
