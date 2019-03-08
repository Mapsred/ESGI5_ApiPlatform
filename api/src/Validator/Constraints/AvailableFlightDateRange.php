<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class AvailableFlightDateRange extends Constraint
{
    public $message = 'This airplane already has a flight during this period';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
