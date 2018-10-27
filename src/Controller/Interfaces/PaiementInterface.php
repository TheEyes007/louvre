<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 02/10/2018
 * Time: 13:29
 */

namespace App\Controller\Interfaces;

use App\Service\SendMailer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Environment;

interface PaiementInterface
{
    /**
     * @param $twig
     * @param $formFactory
     * @param $router
     * @return mixed
     */
    public function __construct(
        Environment $twig,
        EntityManagerInterface $em,
        RouterInterface $router,
        SendMailer $sendMailer
    );

    /**
     * @param $request
     * @return mixed
     */
    public function paiementCommand(Request $request);
}
