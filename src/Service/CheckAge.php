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
     * @var $dateofbirth \DateTime
     */
    private $dateofbirth;

    /**
     * @return bool|int
     */
    public function getAge()
    {
        $str = $this->dateofbirth;
        $date = \DateTime::createFromFormat('d/m/Y', $str);
        if($date != false) {
            $dob = \DateTime::createFromFormat('d/m/Y', $str);
            $age = $dob->diff(new \DateTime('now'));
            return $age->y;
        } else {
            return false;
        }
    }

    /**
     * CheckAge constructor.
     * @param $dateofbirth
     */
    public function __construct($dateofbirth)
    {
        $this->dateofbirth = $dateofbirth;
    }
}