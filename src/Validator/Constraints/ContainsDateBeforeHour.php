<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 09/08/2018
 * Time: 15:42
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class ContainsDateBeforeHour
 * @package App\Validator\Constraints
 * @Annotation
 */
class ContainsDateBeforeHour extends Constraint
{
    /**
     * @return string
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    public $message = 'Date de réservation invalide : Vous ne pouvez plus réserver après 14 heures pour aujourd\'hui.';
}
