<?php
/**
 * Created by PhpStorm.
 * User: Matthieu
 * Date: 19/10/2018
 * Time: 13:37
 */

namespace App\Service\Interfaces;

/**
 * Interface StripeHandlerInterface
 * @package App\Service\Interfaces
 */
interface StripeHandlerInterface
{
    public function __construct
    (
        string $token,
        int $price,
        string $moneyunit
    );

    public function getPaiement($name, $firstname);
}
