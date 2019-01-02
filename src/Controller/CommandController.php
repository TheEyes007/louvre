<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 30/07/2018
 * Time: 18:53
 */

namespace App\Controller;

use App\Controller\Interfaces\CommandInterface;
use App\Domain\Entity\Tickets;
use App\Form\CollectionTicketsType;
use App\Service\CheckAge;
use App\Service\CheckDateofBooking;
use App\Service\CheckTarif;
use App\Service\PriceCalculator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Intl\Intl;

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
        RouterInterface $router,
        EntityManagerInterface $em
    ){
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->em = $em;
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

         $requestSQL = $this->em->getRepository(Tickets::class);

         if ($form->isSubmitted() && $form->isValid()) {
             if ($user->status === false) {
                 return new RedirectResponse($this->router->generate('command'));
             } else {
                 $request->getSession()->set('user', $form->getData());

                 foreach ($user->tickets as $value) {

                     $dateofbooking = $value->dateofbooking;

                     $countDate = $requestSQL->countTicketsbydate($dateofbooking->format('Y-m-d'));

                     if (empty($countDate)) {

                         $age = CheckAge::getAge($value->dateofbirth->format('d/m/Y'));

                         $tarif = CheckTarif::getTarif($age, $value->tarif);
                         $price = PriceCalculator::getPrice($tarif);
                         $countryName = Intl::getRegionBundle()->getCountryName($value->country);
                         $value->tarif = $tarif;
                         $value->age = $age;
                         $value->price = $price;
                         // From code iso generate country name
                         $value->country = $countryName;

                     } else {

                         if (count($countDate) > 0) {

                             if ($countDate[0]['count'] >= 1000) {

                                 $tickets = [];

                                 $message = "Commande annulée. Il n'est pas possible de réserver les jours où plus de 1000 tickets sont vendus";

                                 $request->getSession()->getFlashBag()->add('danger', $message);

                                 return new RedirectResponse($this->router->generate('command'));
                             } else {
                                 $age = CheckAge::getAge($value->dateofbirth->format('d/m/Y'));

                                 $tarif = CheckTarif::getTarif($age, $value->tarif);
                                 $price = PriceCalculator::getPrice($tarif);
                                 $countryName = Intl::getRegionBundle()->getCountryName($value->country);
                                 $value->tarif = $tarif;
                                 $value->age = $age;
                                 $value->price = $price;
                                 // From code iso generate country name
                                 $value->country = $countryName;
                             }
                         }
                    }
                 }
                 return new RedirectResponse($this->router->generate('validation'));
             }
             }else if ($form->isSubmitted() && $form->isValid() === false) {
                 $request->getSession()->getFlashBag()->add('danger', 'Veuillez Ajouter un ticket avant de valider le formulaire.');
             }

         return new Response($this->twig->render('reservation/commands.html.twig',array('usersdto' => $user, 'form' => $form->createView())));
     }

    /**
     * Matches /cancelcommand exactly
     *
     * @Route("/cancelcommand", methods={"GET"}, name="cancelcommand")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function cancelCommand(Request $request)
    {
        $requestDTO = $request->getSession()->get('user');
        $requestDTO->tickets = [];
        return new RedirectResponse($this->router->generate('command'));
    }
}
