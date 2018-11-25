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
 * Class ContainsDateBeforeDay
 * @package App\Validator\Constraints
 * @Annotation
 */
class ContainsDateFreeDay extends Constraint
{
    public $message = 'Date de réservation invalide : {{ string }}. Vous ne pouvez pas réserver des jours fériés';
}
