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
     * @var string $tarif
     */
    private $tarif;

    /**
     * @var string $dateofbooking
     */
    private $dateofbooking;

    /**
     * CheckHalfday constructor.
     * @param $tarif
     * @param $dateofbooking
     */
    public function __construct(
        string $tarif = '',
        string $dateofbooking = ''
    )
    {
        $this->tarif = $tarif;
        $this->dateofbooking = $dateofbooking;
    }

    /**
     * @return array|bool
     */
    public function getHalfday()
    {
        $tarif = $this->tarif;

        if ($tarif === 'Demi-Journée') {

            $dateofbooking = $this->dateofbooking;
            $dateofbooking =  \DateTime::createFromFormat('d/m/Y', $dateofbooking);

            $today = new \DateTime('now');

            if($dateofbooking) {

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

                return $message = ["Format de date incorrect",false];

            }

        } else {

            return $this->getPastday();

        }
    }

    /**
     * @return array|bool
     */
    private function getPastday()
    {
        $dateofbooking = $this->dateofbooking;
        $dateofbooking =  \DateTime::createFromFormat('d/m/Y', $dateofbooking);

        if($dateofbooking) {

            if ($dateofbooking > new \DateTime('now')) {
                return true;
            }

            return $message = ['Réservation impossible à une date antérieure à la date du jour',false];
        }

        return $message = ["Format de date incorrect",false];
    }

    /**
     * @return bool
     */
    public function checkCloseDay()
    {

        return (\DateTime::createFromFormat('d/m/Y', $this->dateofbooking)->format('D') === 'Tue' OR \DateTime::createFromFormat('d/m/Y', $this->dateofbooking)->format('D') === 'Sun')
            ? false
            : true;

    }
}
