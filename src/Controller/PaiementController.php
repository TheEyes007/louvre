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
     * @var String
     */
    private $stripeToken;

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
        SendMailer $sendMailer,
        string $stripeToken
    )
    {
        $this->twig = $twig;
        $this->em = $em;
        $this->router = $router;
        $this->flash = $flash;
        $this->flash = $flash;
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

        // Generateur du contenu du mail

            // numero de commande
            $tokenRegistration = date("YmdGis").strtoupper(substr($user->name,0,2).substr($user->firstname,0,2)).rand(100000,999999 );

            //Information acheteur
            $username = $user->name . ' ' . $user->firstname;
            $email= $user->email;
            $nb_tickets = count($user->tickets);
            $tickets = $user->tickets;

        //Paiement
        $token = $request->request->get('stripeToken');

            // Set your secret key: remember to change this to your live secret key in production
            // See your keys here: https://dashboard.stripe.com/account/apikeys
            \Stripe\Stripe::setApiKey($this->stripeToken);

            if (!\is_null($token)) {

                //Persister en base avant
                //table id, numero de commande, nom, prenom, email, date_reservation, validation
                //table tickets, id, nom, prenom, date de viste, type de billet, prix, command (clé étrangère)

                //Envoi de confirmation de l'adresse mail

                //Paiement

                try {
                    $charge = \Stripe\Charge::create([
                        'amount' => $totalPrice,
                        'currency' => 'eur',
                        'description' => sprintf('Le paiement de %d pour Monsieur/Madame %s %s a été validé', $totalPrice, $user->name, $user->firstname),
                        'source' => $token,
                    ]);

                    $totalPrice = $totalPrice / 100;

                    $request->getSession()->getFlashBag()->add('success','Votre paiement de '. $totalPrice .'€ a été réalisé avec succès. Vous recevrez par courriel vos tickets de réservation');

                    // Envoi du mail de confirmation
                    $this->sendMailer->registration($email, $username, $totalPrice, $nb_tickets, $tickets, $tokenRegistration);

                    return new RedirectResponse($this->router->generate('homepage'));

                } catch(Stripe_CardError $e) {

                    $this->flash->add('danger',$e->getMessage());

                    return new RedirectResponse($this->router->generate('validation'));

                } catch (Stripe_InvalidRequestError $e) {

                    $this->flash->add('danger',$e->getMessage());

                    return new RedirectResponse($this->router->generate('validation'));

                } catch (Stripe_AuthenticationError $e) {

                    $this->flash->add('danger',$e->getMessage());

                    return new RedirectResponse($this->router->generate('validation'));

                } catch (Stripe_ApiConnectionError $e) {

                    $this->flash->add('danger',$e->getMessage());

                    return new RedirectResponse($this->router->generate('validation'));

                } catch (Stripe_Error $e) {

                    $this->flash->add('danger',$e->getMessage());

                    return new RedirectResponse($this->router->generate('validation'));

                } catch (Exception $e) {

                    $this->flash->add('danger',$e->getMessage());

                    return new RedirectResponse($this->router->generate('validation'));

                }
            } else {
                $this->flash->add('danger','Le paiement a échoué. Merci de contacter notre support avant de réitérer votre commande');

                return new RedirectResponse($this->router->generate('validation'));
            }
    }
}
