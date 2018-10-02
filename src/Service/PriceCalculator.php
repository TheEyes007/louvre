<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 05/09/2018
 * Time: 20:20
 */

namespace App\Service;

use App\Service\Interfaces\PriceCalculatorInterface;

class PriceCalculator implements PriceCalculatorInterface
{
    /**
     * @param $dateofbirth
     * @return mixed
     */
    public function getAge($dateofbirth)
    {
        $today = new \DateTime();
        $dateofbirth = new \DateTime($dateofbirth);
        $age = $dateofbirth->diff($today);
        return $age->y;

        //Tester un argument qui n'a pas le bon type/date au mauvais format
    }

    /**
     * @param $dateofbooking
     * @return mixed
     */
    public function getTarif($dateofbirth,$tarif)
    {
        /*
            if ($dateofbirth > 59) {
                $tarif = 'Tarif Senior';
            } elseif ($dateofbirth > 3 AND $dateofbirth < 12) {
                $tarif = 'Tarif Enfant';
            } elseif ($dateofbirth < 4) {
                $tarif = 'Tarif Gratuit';
            } else {
                $tarif = 'Tarif Normal';
            }

            return $tarif;
        */
    }


        /**
     * @param $tarif
     * @return mixed
     */
    public function getPrice($tarif)
    {
        // TODO: Implement getPrice() method.
    }
}
