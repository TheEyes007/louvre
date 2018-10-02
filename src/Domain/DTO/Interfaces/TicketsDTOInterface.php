<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 05/09/2018
 * Time: 20:00
 */

namespace App\Domain\DTO\Interfaces;

/**
 * Interface TicketsDTOInterface
 * @package App\Interfaces
 */
interface TicketsDTOInterface
{
    /**
     * TicketsDTOInterface constructor.
     * @param $name
     * @param $firstname
     * @param $dateofbirth
     * @param $tarif
     * @param $dateofbooking
     * @param $country
     */
    public function __construct
    (
        $name,
        $firstname,
        $dateofbirth,
        $tarif,
        $dateofbooking,
        $country
    );
}
