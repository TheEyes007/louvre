<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 08/10/2018
 * Time: 18:58
 */

namespace App\Service;

use App\Service\Interfaces\CheckAgeInterface;

/**
 * Class CheckAge
 * @package App\Service
 */
class CheckAge implements CheckAgeInterface
{

    /**
     * @return bool|int
     */
    public static function getAge($dateofbirth)
    {
        $date = \DateTime::createFromFormat('d/m/Y', $dateofbirth);
        if($date != false) {
            $dob = \DateTime::createFromFormat('d/m/Y', $dateofbirth);
            $age = $dob->diff(new \DateTime('now'));
            return $age->y;
        } else {
            return false;
        }
    }
}
