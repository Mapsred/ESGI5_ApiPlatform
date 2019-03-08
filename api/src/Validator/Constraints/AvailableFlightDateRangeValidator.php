<?php

namespace App\Validator\Constraints;

use App\Entity\Flight;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @Annotation
 */
final class AvailableFlightDateRangeValidator extends ConstraintValidator
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function validate($value, Constraint $constraint): void
    {
        $flightRepository = $this->manager->getRepository(Flight::class);
        $concurrentFlights = $flightRepository->findConcurrentFlight($value);

        if($concurrentFlights > 0){
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
