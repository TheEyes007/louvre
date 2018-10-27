<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 23/10/2018
 * Time: 13:37
 */

namespace App\Controller;


use App\Controller\Interfaces\MailvalidationInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;

class MailvalidationController implements MailvalidationInterface
{

    /**
     * @var Environment $twig
     */
    private $twig;

    /**
     * @var RouterInterface $router
     */
    private $router;

    /**
     * MailvalidationController constructor.
     * @param Environment $twig
     * @param RouterInterface $router
     */
    public function __construct(Environment $twig, RouterInterface $router)
    {
        $this->twig = $twig;
        $this->router = $router;
    }

    /**
     *
     * @Route("/emailValidation/{token}", methods="GET", name="mailvalidation")
     * @param Request $request
     *
     */
    public function mailvalidation(Request $request, $token)
    {
        if (\is_null($user = $request->getSession()->get('user'))) {
            return new RedirectResponse($this->router->generate('accounts'));
        }

        $user->token = $token;
        $user->status = true;

        return new RedirectResponse($this->router->generate('command'));
    }
}