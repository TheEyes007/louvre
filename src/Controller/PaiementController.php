<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 02/10/2018
 * Time: 13:36
 */

namespace App\Controller;


use App\Controller\Interfaces\PaiementInterface;
use App\Service\SendMailer;
use App\Service\StripeHandler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Twig\Environment;

/**
 * Class ValidationController
 * @package App\Controller
 */
class PaiementController implements PaiementInterface
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
     * @var SendMailer
     */
    private $sendMailer;

    /**
     * ValidationController constructor.
     * @param Environment $twig
     * @param EntityManagerInterface $em
     * @param RouterInterface $router
     */
    public function __construct(
        Environment $twig,
        EntityManagerInterface $em,
        RouterInterface $router,
        SendMailer $sendMailer
    )
    {
        $this->twig = $twig;
        $this->em = $em;
        $this->router = $router;
        $this->sendMailer = $sendMailer;
    }

    /**
     * Matches /paiement exactly
     *
     * @Route("/paiement", methods={"GET","POST"}, name="paiement")
     * @param Request $request
     *
     */
    public function paiementCommand(Request $request)
    {
        if (\is_null($user = $request->getSession()->get('user'))) {
            return new RedirectResponse($this->router->generate('accounts'));
        }

        $totalPrice = 0;

        foreach ($user->tickets as $value) {
            $totalPrice += $value->price;
        }

        $totalPrice = $totalPrice * 100;

        //**************************** Generateur du contenu du mail ******************************//

        // numero de commande
        $tokenRegistration = date("YmdGis") . strtoupper(substr($user->name, 0, 2) . substr($user->firstname, 0, 2)) . rand(100000, 999999);

        //Information acheteur
        $username = $user->name . ' ' . $user->firstname;
        $email = $user->email;
        $tickets = $user->tickets;

        $nb_tickets = count($tickets);


        //************ Réalisation du paiement **********************//

        //Récupération du token
        $token = $request->request->get('stripeToken');

        if (!\is_null($token)) {

            //Récupération du service et de la méthode de paiement si l'envoi du token a été fait coté client.
            $payment = new StripeHandler($token, $totalPrice, 'eur');
            $payment = $payment->getPaiement($user->name, $user->firstname);

            // Vérification si le paiement a été fait
            if ($payment[1] === true) {

                // Conversion du prix pour le mail (en cts par defaut)
                $totalPrice = $totalPrice / 100;

                $request->getSession()->getFlashBag()->add('success', $payment[0]);

                //Envoi du mail

                $this->sendMailer->registration($email, $username, $totalPrice, $nb_tickets, $tickets, $tokenRegistration);

                return new RedirectResponse($this->router->generate('homepage'));

            } else {

                $request->getSession()->getFlashBag()->add('danger', $payment[0]);

                return new RedirectResponse($this->router->generate('validation'));

            }
        } else {

            $request->getSession()->getFlashBag()->add('danger', "Le paiement a échoué. Merci de contacter notre support avant de réitérer votre commande");

            return new RedirectResponse($this->router->generate('validation'));

        }
    }
}
