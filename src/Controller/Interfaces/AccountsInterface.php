<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 04/09/2018
 * Time: 13:07
 */

namespace App\Controller\Interfaces;

use App\Service\SendMailer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Twig\Environment;

interface AccountsInterface
{
    /**
     * @param $twig
     * @param $formFactory
     * @param $router
     * @param $session
     * @return mixed
     */
    public function __construct(
        Environment $twig,
        FormFactoryInterface $formFactory,
        RouterInterface $router,
        SessionInterface $session,
        SendMailer $sendMailer
    );

    /**
     * @param Request $request
     * @return mixed
     */
    public function accountsInfo(Request $request);
}
