<?php
/**
 * Created by PhpStorm.
 * User: Matthieu
 * Date: 28/10/2018
 * Time: 09:31
 */

namespace App\Service;

use App\Service\Interfaces\CheckDateofBookingInterface;

class CheckDateofBooking implements CheckDateofBookingInterface
{

    /**
     * @param $tarif
     * @param $dateofbooking
     * @return array|bool
     */
    public static function getHalfday($tarif, $dateofbooking)
    {

        if($dateofbooking) {

            $dateofbooking =  \DateTime::createFromFormat('d/m/Y', $dateofbooking);

            $today = new \DateTime('now');

            if ($tarif === 'Demi-Journée') {

                $interval = $dateofbooking->diff($today);

                $todayhour = intval($today->format('G'));

                $compareI = $interval->d + $interval->m + $interval->y;

                if ($compareI === 0 && $todayhour < 13) {

                    return true;

                }

                if ($compareI === 0 && $todayhour > 13) {

                    return $message = ["Réservation impossible aujourd'hui après 14h pour un ticket demi-journée", false];

                }

                if ($dateofbooking > $today) {

                    return true;

                }

                if ($dateofbooking < $today) {

                    return $message = ['Réservation impossible à une date antérieure à la date du jour', false];

                }

            } else {

                if ($dateofbooking > $today) {
                    return true;
                }

                return $message = ['Réservation impossible à une date antérieure à la date du jour', false];
            }

        } else {

            return $message = ["Format de date incorrect",false];

        }
    }

    /**
     * @return bool
     */
    public static function checkCloseDay($dateofbooking)
    {
        return (\DateTime::createFromFormat('d/m/Y', $dateofbooking)->format('D') === 'Tue' OR \DateTime::createFromFormat('d/m/Y', $dateofbooking)->format('D') === 'Sun')
            ? false
            : true;

    }
}
