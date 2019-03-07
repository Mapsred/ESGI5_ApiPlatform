<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Flight;
use App\Utils\FlightBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class FlightSubscriber implements EventSubscriberInterface
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;

    /**
     * @var FlightBuilder $flightBuilder
     */
    private $flightBuilder;

    public function __construct(EntityManagerInterface $entityManager, FlightBuilder $flightBuilder)
    {
        $this->entityManager = $entityManager;
        $this->flightBuilder = $flightBuilder;
    }


    public function preWrite(GetResponseForControllerResultEvent $event)
    {
        /** @var Flight $entity */
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
        if ($entity instanceof Flight && $method === Request::METHOD_POST) {
            // Generate Plane Places
            $this->flightBuilder->build($entity);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => [
                ['preWrite', EventPriorities::PRE_WRITE]
            ]
        ];
    }
}
