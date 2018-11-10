<?php
/**
 * Created by PhpStorm.
 * User: Matthieu
 * Date: 19/10/2018
 * Time: 13:37
 */

namespace App\Service\Interfaces;

use Twig\Environment;

/**
 * Interface SendMailerInterface
 * @package App\Service\Interfaces
 */
interface SendMailerInterface
{

    /**
     * SendMailerInterface constructor.
     * @param Environment $twig
     * @param \Swift_Mailer $mailer
     */
    public function __construct(
        Environment $twig,
        \Swift_Mailer $mailer
    );

    /**
     * @param $mailto
     * @param $name
     * @param $tokenConfirmation
     * @return mixed
     */
    public function confirmationEmail
    (
        $mailto,
        $name,
        $tokenConfirmation
    );

    /**
     * @param $mailto
     * @param $name
     * @param $totalprice
     * @param $numbertickets
     * @param $tickets
     * @param $tokenRegistration
     * @return mixed
     */
    public function registration
    (
        $mailto,
        $name,
        $totalprice,
        $numbertickets,
        $tickets,
        $tokenRegistration
    );
}
