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


class ContainsDateFreeDayValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {

        $freeDay = $this->getHolidays($value->format('Y'));

        $validDate = true;

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) take care of that
        if (null === $value || '' === $value) {
            return;
        }

        foreach ($freeDay as $item) {
            $freeD = date('d/m/Y',$item);
            if ($freeD === $value->format('d/m/Y')) {
                $validDate = false;
            }
        }

        if ($validDate === false) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value->format('d/m/Y'))
                ->addViolation();
        }
    }

    /**
     * @param null $year
     * @return array
     */
    private function getHolidays($year = null)
    {
        if ($year === null)
        {
            $year = intval(date('Y'));
        }

        $easterDate  = easter_date($year);
        $easterDay   = date('j', $easterDate);
        $easterMonth = date('n', $easterDate);
        $easterYear   = date('Y', $easterDate);

        $holidays = array(
            // Dates fixes
            mktime(0, 0, 0, 1,  1,  $year),  // 1er janvier
            mktime(0, 0, 0, 5,  1,  $year),  // Fête du travail
            mktime(0, 0, 0, 5,  8,  $year),  // Victoire des alliés
            mktime(0, 0, 0, 7,  14, $year),  // Fête nationale
            mktime(0, 0, 0, 8,  15, $year),  // Assomption
            mktime(0, 0, 0, 11, 1,  $year),  // Toussaint
            mktime(0, 0, 0, 11, 11, $year),  // Armistice
            mktime(0, 0, 0, 12, 25, $year),  // Noel

            // Dates variables
            mktime(0, 0, 0, $easterMonth, $easterDay + 1,  $easterYear),
            mktime(0, 0, 0, $easterMonth, $easterDay + 39, $easterYear),
            mktime(0, 0, 0, $easterMonth, $easterDay + 50, $easterYear),
        );

        sort($holidays);

        return $holidays;
    }
}
