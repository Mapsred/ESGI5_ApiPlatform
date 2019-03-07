<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Airplane;
use App\Entity\AirStrip;
use App\Utils\AirplaneBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class AirplaneSubscriber implements EventSubscriberInterface
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    private $entityManager;

    /**
     * @var AirplaneBuilder $airplaneBuilder
     */
    private $airplaneBuilder;

    public function __construct(EntityManagerInterface $entityManager, AirplaneBuilder $airplaneBuilder)
    {
        $this->entityManager = $entityManager;
        $this->airplaneBuilder = $airplaneBuilder;
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

            if (null !== $airstrip) {
                $entity->setAirstrip($airstrip);
            }
        }
    }

    public function preWrite(GetResponseForControllerResultEvent $event)
    {
        /** @var Airplane $entity */
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
        if ($entity instanceof Airplane && $method === Request::METHOD_POST) {
            // Generate Staff and Pilot
            $this->airplaneBuilder->build($entity);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => [
                ['preValidate', EventPriorities::PRE_VALIDATE],
                ['preWrite', EventPriorities::PRE_WRITE]
            ]
        ];
    }
}
