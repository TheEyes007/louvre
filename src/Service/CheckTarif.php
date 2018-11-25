<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 08/10/2018
 * Time: 19:00
 */

namespace App\Service;

use App\Service\Interfaces\CheckTarifInterface;

/**
 * Class CheckTarif
 * @package App\Service
 */
class CheckTarif implements CheckTarifInterface
{

    /**
     * @return string
     */
    public static function getTarif($age, $tarif)
    {

        if ($tarif === 'Tarif Normal') {
            if ($age < 4) {
                $tarif = 'Tarif Gratuit';
            } elseif ($age >= 4 And $age < 12) {
                $tarif = 'Tarif Enfant';
            } elseif ($age >= 12 And $age < 60) {
                $tarif = 'Tarif Normal';
            } elseif ($age >= 60) {
                $tarif = 'Tarif Senior';
            }
        }

        return $tarif;
    }
}
