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

/**
 * Class PriceCalculatorTest
 * @package Tests\Service
 */
class PriceCalculatorTest extends TestCase
{

    /**
     * Compare value Price Half day
     */
    public function testGetPriceHalfday()
    {
        $tarif = 'Demi-Journée';
        $price = PriceCalculator::getPrice($tarif);
        $this->assertSame(8, $price);
    }

    /**
     * Compare value Price Normal
     */
    public function testGetPriceNormal()
    {
        $tarif = 'Tarif Normal';
        $price = PriceCalculator::getPrice($tarif);
        $this->assertSame(16, $price);
    }

    /**
     * Compare value Price Half day
     */
    public function testGetPriceReduce()
    {
        $tarif = 'Tarif Réduit';
        $price = PriceCalculator::getPrice($tarif);
        $this->assertSame(10, $price);
    }

    /**
     * Compare value Price Half day
     */
    public function testGetPriceFree()
    {
        $tarif = 'Tarif Gratuit';
        $price = PriceCalculator::getPrice($tarif);
        $this->assertSame(0, $price);
    }

    /**
     * Compare value Price Half day
     */
    public function testGetPriceSenior()
    {
        $tarif = 'Tarif Senior';
        $price = PriceCalculator::getPrice($tarif);
        $this->assertSame(12, $price);
    }

    /**
     * Compare value Price Half day
     */
    public function testGetPriceChild()
    {
        $tarif = 'Tarif Enfant';
        $price = PriceCalculator::getPrice($tarif);
        $this->assertSame(8, $price);
    }
}
