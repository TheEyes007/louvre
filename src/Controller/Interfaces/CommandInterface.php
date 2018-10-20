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
use Symfony\Component\Form\FormFactoryInterface;


use Twig\Environment;

interface CommandInterface
{
    /**
     * @param $twig
     * @param $formFactory
     * @param $router
     * @return mixed
     */
    public function __construct(
        Environment $twig,
        FormFactoryInterface $formFactory,
        RouterInterface $router
    );

    /**
     * @param $request
     * @return mixed
     */
    public function commandInfo(Request $request);
}
