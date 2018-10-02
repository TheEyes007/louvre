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
     * @param $dateofbirth
     * @return mixed
     */
    public function getAge($dateofbirth);

    /**
     * @param $dateofbooking
     * @return mixed
     */
    public function getTarif($dateofbirth,$tarif);

    /**
     * @param $tarif
     * @return mixed
     */
    public function getPrice($tarif);
}