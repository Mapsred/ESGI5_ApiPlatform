<?php

namespace App\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Passenger;
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

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public static function getSubscribedEvents()
    {
        return [
            'kernel.view' => [
                'preWrite', EventPriorities::PRE_WRITE
            ],
        ];
    }

    public function preWrite(GetResponseForControllerResultEvent $event)
    {
        /** @var Passenger $entity */
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
        if ($entity instanceof Passenger && $method === Request::METHOD_POST) {

        }
    }
}