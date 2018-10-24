<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 30/07/2018
 * Time: 18:53
 */

namespace App\Controller;

use App\Controller\Interfaces\AccountsInterface;
use App\Service\SendMailer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use App\Form\UsersType;

/**
 * Class accountsController
 * @package App\Controller
 */
class AccountsController implements AccountsInterface
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
     * @var SessionInterface
     */
    private $session;

    /**
     * @var SendMailer
     */
    private $sendMailer;

    /**
     * @param Environment $twig
     * @param FormFactoryInterface $formFactory
     * @param RouterInterface $router
     * @param SessionInterface $session
     */
    public function __construct(
        Environment $twig,
        FormFactoryInterface $formFactory,
        RouterInterface $router,
        SessionInterface $session,
        SendMailer $sendMailer
    )
    {
        $this->twig = $twig;
        $this->router = $router;
        $this->formFactory = $formFactory;
        $this->session = $session;
        $this->sendMailer = $sendMailer;
    }

    /**
     * Matches /accounts exactly
     *
     * @Route("/accounts", methods={"GET","POST"}, name="accounts")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function accountsInfo(Request $request)
    {
        $form = $this->formFactory->create(UsersType::class)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->session->set('user', $form->getData());

            $token = uniqid();

            $this->sendMailer->confirmationEmail(
                $this->session->get('user')->email,
                $this->session->get('user')->name,
                $token
            );

            return new RedirectResponse($this->router->generate('command'));
        }

        return new Response($this->twig->render('reservation/accounts.html.twig',array(
            'form' => $form->createView(),
        )));
    }
}
