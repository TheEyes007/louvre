<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 06/09/2018
 * Time: 13:50
 */

namespace Tests\Service;

use App\Service\CheckTarif;
use PHPUnit\Framework\TestCase;

/**
 * Class CheckTarifTest
 * @package Tests\Service
 */
class CheckTarifTest extends TestCase
{

    /**
     * Compare value Demi-Journée
     */
    public function testGetDemijournee()
    {
        $tarif = 'Demi-Journée';
        $tarif = CheckTarif::getTarif(20, $tarif);
        $this->assertSame('Demi-Journée', $tarif);
    }

    /**
     * Compare value Tarif réduit
     */
    public function testGetTarifreduit()
    {
        $tarif = 'Tarif Réduit';
        $tarif = CheckTarif::getTarif(20, $tarif);
        $this->assertSame('Tarif Réduit', $tarif);
    }

    /**
     * Compare value Tarif Gratuit
     */
    public function testGetTarifgratuit()
    {
        $tarif = 'Tarif Normal';
        $tarif = CheckTarif::getTarif(3, $tarif);
        $this->assertSame('Tarif Gratuit', $tarif);
    }

    /**
     * Compare value Tarif Enfant
     */
    public function testGetTarifenfant()
    {
        $tarif = 'Tarif Normal';
        $tarif = CheckTarif::getTarif(5, $tarif);
        $this->assertSame('Tarif Enfant', $tarif);
    }

    /**
     * Compare value Tarif Adulte/Normal
     */
    public function testGetTarifnormal()
    {
        $tarif = 'Tarif Normal';
        $tarif = CheckTarif::getTarif(20, $tarif);
        $this->assertSame('Tarif Normal', $tarif);
    }

    /**
     * Compare value Tarif Senior
     */
    public function testGetTarifsenior()
    {
        $tarif = 'Tarif Normal';
        $tarif = CheckTarif::getTarif(63, $tarif);
        $this->assertSame('Tarif Senior', $tarif);
    }
}
