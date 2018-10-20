<?php
/**
 * Created by PhpStorm.
 * User: Matthieu
 * Date: 19/10/2018
 * Time: 13:39
 */

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class SendMailer
{
    /**
     * @var \Twig_Environment
     */
    private $templating;

    /**
     * SendMailer constructor.
     * @param \Swift_Mailer $mailer
     * @param \Twig_Environment $templating
     */
    public function __construct(\Twig_Environment $templating)
    {
        $this->templating = $templating;
    }

    public function sendEmail
    (
        $mailto,
        $name,
        \Swift_Mailer $mailer
    )
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('send@example.com')
            ->setTo($mailto)
            ->setBody(
                $this->templating->render('emails/registration.html.twig', ['name' => $name]),
                'text/html'
            );

        $mailer->send($message);

    }
}
