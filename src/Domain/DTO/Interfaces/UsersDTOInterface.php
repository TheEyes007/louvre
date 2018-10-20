<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 05/09/2018
 * Time: 20:00
 */

namespace App\Domain\DTO\Interfaces;

/**
 * Interface UsersDTOInterface
 * @package App\Interfaces
 */
interface UsersDTOInterface
{
    /**
     * UsersDTOInterface constructor.
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
    );
}