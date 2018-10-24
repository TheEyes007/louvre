<?php
/**
 * Created by PhpStorm.
 * User: Matthieu
 * Date: 19/10/2018
 * Time: 13:39
 */

namespace App\Service;

use Twig\Environment;

class SendMailer
{

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * SendMailer constructor.
     * @param Environment $twig
     * @param \Swift_Mailer $mailer
     */
    public function __construct(
        Environment $twig,
        \Swift_Mailer $mailer
    )
    {
        $this->twig = $twig;
        $this->mailer = $mailer;
    }

    public function registration
    (
        $mailto,
        $name,
        $totalprice,
        $numbertickets,
        $tickets,
        $tokenRegistration
    )
    {

        $message = (new \Swift_Message('[Réservation] Validation de votre réservation aux musée du louvre'))
            ->setFrom('mvib1983@gmail.com')
            ->setTo($mailto)
            ->setBody(
                $this->twig->render('emails/registration.html.twig',
                    [
                        'name' => $name,
                        'totalprice' => $totalprice,
                        'numbertickets' => $numbertickets,
                        'tickets' => $tickets,
                        'tokenRegistration' => $tokenRegistration
                    ]),
                'text/html'
            );

        $this->mailer->send($message);

    }

    public function confirmationEmail
    (
        $mailto,
        $name,
        $tokenConfirmation
    )
    {

        $message = (new \Swift_Message('[Confirmation] Validation de votre Email'))
            ->setFrom('mvib1983@gmail.com')
            ->setTo($mailto)
            ->setBody(
                $this->twig->render('emails/confirmation.html.twig',
                    [
                        'name' => $name,
                        'tokenConfirmation' => $tokenConfirmation
                    ]),
                'text/html'
            );

        $this->mailer->send($message);
    }
}
