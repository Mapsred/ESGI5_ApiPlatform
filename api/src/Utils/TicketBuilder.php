<?php

namespace App\Utils;

use App\Entity\Ticket;
use App\Entity\Passenger;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class TicketBuilder
 * @package App\Utils
 */
class TicketBuilder
{
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
     */
    public function build(Passenger $passenger)
    {
        $this->createTicket($passenger);
        $this->manager->flush();
    }

    /**
     * @param Passenger $passenger
     */
    private function createTicket(Passenger $passenger)
    {
        $ticket = new Ticket();
        $ticket->setPassenger($passenger);
        $this->manager->persist($ticket);
    }
}
