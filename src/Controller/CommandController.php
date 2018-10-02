<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 30/07/2018
 * Time: 18:53
 */

namespace App\Controller;

use App\Controller\Interfaces\CommandInterface;
use App\Form\CollectionTicketsType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class accountsController
 * @package App\Controller
 */
class CommandController implements CommandInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @param Environment $twig
     * @param FormFactoryInterface $formFactory
     * @param RouterInterface $router
     */
    public function __construct(
        Environment $twig,
        FormFactoryInterface $formFactory,
        RouterInterface $router
    ){
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->router = $router;
    }

    /**
     * Matches /command exactly
     *
     * @Route("/command", methods={"GET","POST"}, name="command")
     * @param Request $request
     * @return RedirectResponse|Response
     */
     public function commandInfo(Request $request)
     {
         if (\is_null($user = $request->getSession()->get('user'))) {
             return new RedirectResponse($this->router->generate('accounts'));
         }

         $form = $this->formFactory->create(CollectionTicketsType::class, $user)->handleRequest($request);
         
         return new Response($this->twig->render('reservation/commands.html.twig',array('usersdto' => $user, 'form' => $form->createView())));
     }
}
