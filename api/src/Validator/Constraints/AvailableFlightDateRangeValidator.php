<?php

namespace App\Validator\Constraints;

use App\Entity\Airplane;
use App\Entity\Flight;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @Annotation
 */
final class AvailableFlightDateRangeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        /**
         * @var Airplane $airplane
         * @var \DateTime $departureDate
         * @var \DateTime $arrivalDate
         */
        $departureDate = $value->getDepartureDate();
        $arrivalDate = $value->getArrivalDate();
        $airplane = $value->getAirPlane();

        $departureDateTimestamp = $departureDate->getTimestamp();
        $arrivalDateTimestamp = $arrivalDate->getTimestamp();

        $airplaneFlights = $airplane->getFlights();

        if(!empty($airplaneFlights)){
            /**
             * @var Flight $flight
             */
            foreach ($airplaneFlights as $flight) {
                 $flight->getDepartureDate();
                 $tmpDepartureDateTimestamp = $flight->getDepartureDate()->getTimestamp();
                 $tmpArrivalDateTimestamp = $flight->getArrivalDate()->getTimestamp();

                 if($departureDateTimestamp >= $tmpDepartureDateTimestamp && $departureDateTimestamp <= $tmpArrivalDateTimestamp ||
                     $arrivalDateTimestamp >= $tmpDepartureDateTimestamp && $arrivalDateTimestamp <= $tmpArrivalDateTimestamp ||
                     $departureDateTimestamp <= $tmpDepartureDateTimestamp && $arrivalDateTimestamp >= $tmpDepartureDateTimestamp ||
                     $departureDateTimestamp <= $tmpArrivalDateTimestamp && $arrivalDateTimestamp >= $tmpArrivalDateTimestamp ){
                     $this->context->buildViolation($constraint->message)->addViolation();
                     break;
                 }
            }
        }
    }
}