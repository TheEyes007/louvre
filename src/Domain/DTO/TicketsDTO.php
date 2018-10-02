<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 03/08/2018
 * Time: 21:02
 */

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\TicketsDTOInterface;

/**
 * Class TicketsDTO
 * @package App\DTO
 */
class TicketsDTO implements TicketsDTOInterface
{
    /**
     * @var string $name
     */
    public $name;

    /**
     * @var string $firstname
     */
    public $firstname;

    /**
     * @var datetime $dateofbirth
     */
    public $dateofbirth;

    /**
     * @var string $tarif
     */
    public $tarif;

    /**
     * @var datetime $dateofbooking
     */
    public $dateofbooking;

    /**
     * @var string $country
     */
    public $country;

    /**
     * @var int $age
     */
    public $age;

    /**
     * @var int $price
     */
    public $price;

    /**
     * TicketsDTO constructor.
     * @param $name
     * @param $firstname
     * @param $dateofbirth
     * @param $tarif
     * @param $dateofbooking
     * @param $country
     */
    public function __construct(
        $name,
        $firstname,
        $dateofbirth,
        $tarif,
        $dateofbooking,
        $country
    ) {
        $this->name = $name;
        $this->firstname = $firstname;
        $this->dateofbirth = $dateofbirth;
        $this->tarif = $tarif;
        $this->dateofbooking = $dateofbooking;
        $this->country = $country;
    }
}
