<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 09/08/2018
 * Time: 15:42
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


class ContainsDateBeforeDayValidator extends ConstraintValidator
{

    public function validate($tickets, Constraint $constraint)
    {
        $today = new \DateTime('now');

        if ($tickets->tarif === 'Tarif Demi-Journée') {
            if ($tickets->dateofbooking->format('d/m/Y') < $today->format('d/m/Y')) {
                $this->context->buildViolation($constraint->message)
                    ->atPath('dateofbooking')
                    ->addViolation();
            }
        } else {
            if ($tickets->dateofbooking->format('d/m/Y') <= $today->format('d/m/Y')) {
                $this->context->buildViolation($constraint->message)
                    ->atPath('dateofbooking')
                    ->addViolation();
            }
        }
    }
}
