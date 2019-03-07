<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class AvailableFlightDateRange extends Constraint
{
    public $message = 'This airplane has ever a flight at this date';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}