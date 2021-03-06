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
 * Class ContainsMajorAge
 * @package App\Validator\Constraints
 * @Annotation
 */
class ContainsMajorAge extends Constraint
{
    public $message = 'Vous avez "{{ string }}" ans. Vous devez avoir 18 ans pour commander.';
}