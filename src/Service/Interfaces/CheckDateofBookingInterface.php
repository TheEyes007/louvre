<?php
/**
 * Created by PhpStorm.
 * User: Matthieu
 * Date: 28/10/2018
 * Time: 09:14
 */

namespace App\Service\Interfaces;


interface CheckDateofBookingInterface
{

    public static function getHalfday($tarif, $dateofbooking);

    public static function checkCloseDay($dateofbooking);
}