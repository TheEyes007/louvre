<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 04/09/2018
 * Time: 13:07
 */

namespace App\Controller\Interfaces;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

interface MailvalidationInterface
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
        RouterInterface $router
    );

    /**
     * @param Request $request
     * @return mixed
     */
    public function mailvalidation(Request $request, $token);
}
