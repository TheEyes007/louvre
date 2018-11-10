<?php
/**
 * Created by PhpStorm.
 * User: Matthieu
 * Date: 28/10/2018
 * Time: 09:12
 */

namespace Tests\Service;


use App\Service\CheckDateofBooking;
use PHPUnit\Framework\TestCase;

class CheckDateofBookingTest extends TestCase
{
    /**
     * Compare value Demi-Journée.
     * Test sur date postérieur : ok
     * Test sur heure postérieur : ok
     */
    public function testGetDemijourneeTrue()
    {
        $tarif = new CheckDateofBooking('Demi-Journée', '10/11/2018');
        $tarif = $tarif->getHalfday();
        $this->assertSame(true, $tarif);
    }

    /**
     * Compare value Demi-Journée.
     * Test sur date antérieur : error
     * Test sur heure antérieur à 14 : error
     * Test sur format Y/m/d : error
     */
    public function testGetDemijourneeFalse()
    {
        $tarif = new CheckDateofBooking('Demi-Journée', '09/11/2018');
        $tarif = $tarif->getHalfday();
        $this->assertSame(null, $tarif[0]);
    }

    public function testGetJourneeFalse()
    {
        $tarif = new CheckDateofBooking('Normal', '09/11/2018');
        $tarif = $tarif->getHalfday();
        $this->assertSame(null, $tarif[0]);
    }

    public function testGetJourneeTrue()
    {
        $tarif = new CheckDateofBooking('Normal', '10/11/2018');
        $tarif = $tarif->getHalfday();
        $this->assertSame(true, $tarif);
    }

    public function testDayClose()
    {
        $dayClose = new CheckDateofBooking('Normal', '16/12/2018');
        $dayClose = $dayClose->CheckCloseDay();
        $this->assertSame(true, $dayClose);
    }
}
