<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 03/08/2018
 * Time: 21:02
 */

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\UsersDTOInterface;

/**
 * Class UsersDTO
 * @package App\DTO
 */
class UsersDTO implements UsersDTOInterface
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
     * @var string $email
     */
    public $email;

    /**
     * @var array $tickets
     */
    public $tickets = [];

    /**
     * UsersDTO constructor.
     * @param $name
     * @param $firstname
     * @param $dateofbirth
     * @param $email
     */
    public function __construct(
        $name,
        $firstname,
        $dateofbirth,
        $email
    ) {
        $this->name = $name;
        $this->firstname = $firstname;
        $this->dateofbirth = $dateofbirth;
        $this->email = $email;
    }
}
