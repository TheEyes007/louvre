<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 02/10/2018
 * Time: 13:29
 */

namespace App\Controller\Interfaces;

use App\Service\SendMailer;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;


interface ContactsInterface
{
    /**
     * @param $twig
     * @return mixed
     */
    public function __construct(
        Environment $twig,
        FormFactoryInterface $formFactory,
        RouterInterface $router,
        SendMailer $sendMailer
    );

    /**
     * @param $request
     * @return mixed
     */
    public function contactsCommand(Request $request);
}
