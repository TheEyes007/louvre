<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 05/09/2018
 * Time: 20:14
 */

namespace App\Service\Interfaces;

/**
 * Interface CheckAgeInterface
 * @package App\Service\Interfaces
 */
interface CheckAgeInterface
{

    /**
     * @return mixed
     */
    public static function getAge($dateofbirth);
}
