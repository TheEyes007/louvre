<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 02/10/2018
 * Time: 13:36
 */

namespace App\Controller;


use App\Controller\Interfaces\ValidationInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Twig\Environment;

/**
 * Class ValidationController
 * @package App\Controller
 */
class ValidationController implements ValidationInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * ValidationController constructor.
     * @param Environment $twig
     * @param EntityManagerInterface $em
     * @param RouterInterface $router
     */
    public function __construct(Environment $twig, EntityManagerInterface $em, RouterInterface $router)
    {
        $this->twig = $twig;
        $this->em = $em;
        $this->router = $router;
    }

    /**
     * Matches /validation exactly
     *
     * @Route("/validation", methods={"GET","POST"}, name="validation")
     * @param Request $request
     *
     */
    public function validationCommand(Request $request)
    {
        if (\is_null($user = $request->getSession()->get('user'))) {
            return new RedirectResponse($this->router->generate('accounts'));
        }

        $totalPrice = 0;

        foreach ($user->tickets as $value) {
            $totalPrice += $value->price;
        }

        return new Response($this->twig->render('reservation/validation.html.twig',array('usersdto' => $user, 'totalPrice' => $totalPrice)));
    }
}
