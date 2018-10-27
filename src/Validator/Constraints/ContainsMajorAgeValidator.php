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

class ContainsMajorAgeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) take care of that
        if (null === $value || '' === $value) {
            return;
        }

        $now = new \DateTime();
        $age = $now->diff($value);

        if($age->y < 18)
        {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $age->y)
                ->addViolation();
        }
    }
}