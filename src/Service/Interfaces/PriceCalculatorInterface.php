<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 05/09/2018
 * Time: 20:14
 */

namespace App\Service\Interfaces;

/**
 * Interface UsersServiceInterface
 * @package App\Interfaces
 */
interface PriceCalculatorInterface
{

    /**
     * @return mixed
     */
    public static function getPrice($tarif);
}
