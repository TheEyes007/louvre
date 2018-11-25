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

class ContainsDateCloseDayValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) take care of that
        if (null === $value || '' === $value) {
            return;
        }

        $today = new \DateTime('now');

        if ($value->format('D') === 'Tue' OR $value->format('D') === 'Sun') {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ string }}', $value->format('d/m/Y'))
                    ->addViolation();
        }
    }
}
