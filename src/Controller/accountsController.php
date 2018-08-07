<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 30/07/2018
 * Time: 18:53
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Twig\Environment;
use App\Form\AccountsType;
use App\DTO\usersParams;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class accountsController
 * @package App\Controller
 */
class accountsController
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
    public function __construct(Environment $twig, FormFactoryInterface $formFactory, RouterInterface $router){
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->router = $router;
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
     public function accountsInfo(Request $request){
         $session = new Session();
         $session->start();
         $userparams = new usersParams();
         $form = $this->formFactory->create(AccountsType::class);
         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
             $userparams = $form->getData();
             $session->set('userparams',$userparams);
             return new RedirectResponse($this->router->generate('tickets'));
         }

         return new Response($this->twig->render('reservation/accounts.html.twig',array(
             'form' => $form->createView(),
         )));
     }


}