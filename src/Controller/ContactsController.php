<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 20/11/2018
 * Time: 13:18
 */

namespace App\Controller;

use App\Controller\Interfaces\ContactsInterface;
use App\Form\ContactsType;
use App\Service\SendMailer;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

/**
 * Class accountsController
 * @package App\Controller
 */
class ContactsController implements ContactsInterface
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
     * @var SendMailer
     */
    private $sendMailer;

    public function __construct(
        Environment $twig,
        FormFactoryInterface $formFactory,
        RouterInterface $router,
        SendMailer $sendMailer
    )
    {
        $this->twig = $twig;
        $this->router = $router;
        $this->formFactory = $formFactory;
        $this->sendMailer = $sendMailer;
    }

    /**
     * Matches /contact exactly
     *
     * @Route("/contact", methods={"GET","POST"}, name="contact")
     * @return Response
     */
    public function contactsCommand(Request $request)
    {
        $form = $this->formFactory->create(ContactsType::class)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            try {
                $this->sendMailer->contactMail($task['name'], $task['titre'], $task['email'], $task['description']);
            }catch(\Exception $e){
                $request->getSession()->getFlashBag()->add('danger', "Erreur lors de l'envoi du mail : $e");
            }

            $request->getSession()->getFlashBag()->add('success', 'Votre email a été envoyé avec succès');

            return new RedirectResponse($this->router->generate('homepage'));
        }

        return new Response($this->twig->render('site/contacts.html.twig',array(
            'form' => $form->createView(),
        )));


    }
}
