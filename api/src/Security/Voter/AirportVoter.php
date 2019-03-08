<?php

namespace App\Security\Voter;

use App\Entity\Airport;
use App\Repository\AirportRepository;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class AirportVoter extends Voter
{
    const AIRPORT_CREATE = 'airport_create';

    /**
     * @var Security
     */
    private $security;

    /**
     * @var AirportRepository
     */
    private $airportRepository;

    public function __construct(Security $security, AirportRepository $airportRepository)
    {
        $this->security = $security;
        $this->airportRepository = $airportRepository;
    }

    protected function supports($attribute, $subject)
    {
        return in_array($attribute, [self::AIRPORT_CREATE])
            && $subject instanceof Airport;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case self::AIRPORT_CREATE:
                return $this->canCreateAirport();
                break;
        }

        return false;
    }

    private function canCreateAirport()
    {
        return $this->security->isGranted('ROLE_ADMIN') && $this->airportRepository->count([]) <= 20;
    }
}
