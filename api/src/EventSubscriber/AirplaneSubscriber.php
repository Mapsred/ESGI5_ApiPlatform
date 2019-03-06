<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Airplane;
use App\Entity\AirStrip;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;

class AirplaneSubscriber implements EventSubscriberInterface
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function preValidate(GetResponseForControllerResultEvent $event)
    {
        /** @var Airplane $entity */
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
        if ($entity instanceof Airplane && $method === Request::METHOD_POST) {
            $airstrip = $this->entityManager->getRepository(AirStrip::class)->findOneBy([
                'airplane' => null,
                'airport' => $entity->getAirport()
            ]);

            $entity->setAirstrip($airstrip);
        }
    }

    public function preWrite(GetResponseForControllerResultEvent $event)
    {
        /** @var Airplane $entity */
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
        if ($entity instanceof Airplane && $method === Request::METHOD_POST) {
            // TODO Generate Staff / Pilot / Tickets / ...
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.view' => [
                'preValidate', EventPriorities::PRE_VALIDATE,
                'preWrite', EventPriorities::PRE_WRITE
            ],
        ];
    }
}
