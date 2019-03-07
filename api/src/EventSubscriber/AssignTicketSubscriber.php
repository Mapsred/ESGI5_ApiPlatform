<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Passenger;
use App\Utils\TicketBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;

class AssignTicketSubscriber implements EventSubscriberInterface
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;

    /**
     * @var TicketBuilder $ticketBuilder
     */
    private $ticketBuilder;

    public function __construct(EntityManagerInterface $entityManager, TicketBuilder $ticketBuilder)
    {
        $this->entityManager = $entityManager;
        $this->ticketBuilder = $ticketBuilder;
    }
    public static function getSubscribedEvents()
    {
        return [
            'kernel.view' => [
                'postWrite', EventPriorities::POST_WRITE
            ],
        ];
    }

    public function postWrite(GetResponseForControllerResultEvent $event)
    {
        /** @var Passenger $entity */
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
        if ($entity instanceof Passenger && $method === Request::METHOD_POST) {
            $this->ticketBuilder->build($entity);
        }
    }
}