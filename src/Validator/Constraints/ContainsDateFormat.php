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
 * Class ContainsDateFormat
 * @package App\Validator\Constraints
 * @Annotation
 */
class ContainsDateFormat extends Constraint
{
    public $message = 'La date "{{ string }}" n\'est pas au bon format';
}