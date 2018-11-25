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
 * Class ContainsDateCloseDay
 * @package App\Validator\Constraints
 * @Annotation
 */
class ContainsDateCloseDay extends Constraint
{
    public $message = 'Date de réservation invalide : "{{ string }}". Vous ne pouvez réserver un mardi ou un dimanche.';
}