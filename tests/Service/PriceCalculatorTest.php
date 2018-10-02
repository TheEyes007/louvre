<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 06/09/2018
 * Time: 13:50
 */

namespace Tests\Service;

use App\Service\PriceCalculator;
use PHPUnit\Framework\TestCase;

class PriceCalculatorTest extends TestCase
{
    public function getAgeTest()
    {
        $dateofbirth = '02/12/1983';
        $usersService = new PriceCalculator();
        $age = $usersService->getAge($dateofbirth);
        $this->assertSame(35,$age);
    }

    /*
    public function getTarifTest()
    {
        $tarif = 'Tarif normal';
        $age = 85;
        $usersService = new PriceCalculator();
        $age = $usersService->getTarif($tarif);
        $this->assertSame('Tarif Normal',$tarif);
    }
    */
}
