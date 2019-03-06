<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class HashPasswordSubscriber implements EventSubscriberInterface
{
    /** @var UserPasswordEncoder $passwordEncoder */
    private $passwordEncoder;

    /**
     * HashPasswordListener constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        /** @var User $entity */
        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($entity instanceof User && $method === Request::METHOD_POST && null !== $entity->getPlainPassword()) {
            $encoded = $this->passwordEncoder->encodePassword($entity, $entity->getPlainPassword());
            $entity->setPassword($encoded);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
           'kernel.view' => ['onKernelView', EventPriorities::PRE_WRITE]
        ];
    }
}
