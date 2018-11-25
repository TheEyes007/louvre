<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 08/10/2018
 * Time: 19:00
 */

namespace App\Service;

use App\Service\Interfaces\PriceCalculatorInterface;

/**
 * Class PriceCalculator
 * @package App\Service
 */
class PriceCalculator implements PriceCalculatorInterface
{

    /**
     * @return int
     */
    public static function getPrice($tarif)
    {
        switch ($tarif) {
            case 'Tarif Normal':
                return 16;
                break;
            case 'Demi-Journée':
                return 8;
                break;
            case 'Tarif Réduit':
                return 10;
                break;
            case 'Tarif Gratuit':
                return 0;
                break;
            case 'Tarif Enfant':
                return 8;
                break;
            case 'Tarif Senior':
                return 12;
                break;
        }
    }
}
