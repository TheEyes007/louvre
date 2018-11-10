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
        $price = new PriceCalculator($tarif);
        $price = $price->getPrice();
        $this->assertSame(8, $price);
    }

    /**
     * Compare value Price Normal
     */
    public function testGetPriceNormal()
    {
        $tarif = 'Tarif Normal';
        $price = new PriceCalculator($tarif);
        $price = $price->getPrice();
        $this->assertSame(16, $price);
    }

    /**
     * Compare value Price Half day
     */
    public function testGetPriceReduce()
    {
        $tarif = 'Tarif Réduit';
        $price = new PriceCalculator($tarif);
        $price = $price->getPrice();
        $this->assertSame(10, $price);
    }

    /**
     * Compare value Price Half day
     */
    public function testGetPriceFree()
    {
        $tarif = 'Tarif Gratuit';
        $price = new PriceCalculator($tarif);
        $price = $price->getPrice();
        $this->assertSame(0, $price);
    }

    /**
     * Compare value Price Half day
     */
    public function testGetPriceSenior()
    {
        $tarif = 'Tarif Senior';
        $price = new PriceCalculator($tarif);
        $price = $price->getPrice();
        $this->assertSame(12, $price);
    }

    /**
     * Compare value Price Half day
     */
    public function testGetPriceChild()
    {
        $tarif = 'Tarif Enfant';
        $price = new PriceCalculator($tarif);
        $price = $price->getPrice();
        $this->assertSame(8, $price);
    }
}
