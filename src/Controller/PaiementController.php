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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Twig\Environment;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

/**
 * Class ValidationController
 * @package App\Controller
 */
class PaiementController implements PaiementInterface{
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
     * @var FlashBagInterface
     */
    private $flash;

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
        FlashBagInterface $flash
    )
    {
        $this->twig = $twig;
        $this->em = $em;
        $this->router = $router;
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

        $token = $request->request->get('stripeToken');

            // Set your secret key: remember to change this to your live secret key in production
            // See your keys here: https://dashboard.stripe.com/account/apikeys
            \Stripe\Stripe::setApiKey("sk_test_MQAS1lh4BbBYUuJQ89JJolHO");

            if ($token != NULL) {
                try {

                    $charge = \Stripe\Charge::create([
                        'amount' => $totalPrice,
                        'currency' => 'eur',
                        'description' => 'Le paiement de ' . $totalPrice . ' pour Monsieur/Madame ' . $user->name . ' ' . $user->firstname . ' a été validé',
                        'source' => $token,
                    ]);

                    $totalPrice = $totalPrice / 100;

                    $this->flash->add('success','Votre paiement de '. $totalPrice .'€ a été réalisé avec succès. Vous recevrez par courriel vos tickets de réservation');

                    // Envoi du mail de confirmation
                    $username = $user->name . ' ' . $user->firstname;
                    $email= $user->email;

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
                    // Network communication with Stripe failed
                    $error4 = $e->getMessage();
                } catch (Stripe_Error $e) {

                    $this->flash->add('danger',$e->getMessage());

                    return new RedirectResponse($this->router->generate('validation'));

                } catch (Exception $e) {

                    $this->flash->add('danger',$e->getMessage());

                    return new RedirectResponse($this->router->generate('validation'));

                }
            } else {
                $this->flash->add('danger','Le paiement a échoué. Merci de réitérer votre commande');

                return new RedirectResponse($this->router->generate('validation'));
            }
    }
}
