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
use App\Service\CheckAge;
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

         if ($form->isSubmitted() && $form->isValid()) {
             if ($user->status === false) {
                 return new RedirectResponse($this->router->generate('command'));
             } else {
                 $request->getSession()->set('user', $form->getData());

                 foreach ($user->tickets as $value) {
                     $age = new CheckAge($value->dateofbirth->format('d/m/Y'));
                     $age = $age->getAge();
                     $tarif = new CheckTarif($age, $value->tarif);
                     $tarif = $tarif->getTarif();
                     $price = new PriceCalculator($tarif);
                     $price = $price->getPrice();
                     $countryName = Intl::getRegionBundle()->getCountryName($value->country);
                     $value->tarif = $tarif;
                     $value->age = $age;
                     $value->price = $price;
                     // From code iso generate country name
                     $value->country = $countryName;
                 }
                 return new RedirectResponse($this->router->generate('validation'));
             }
         } else if ($form->isSubmitted() && $form->isValid() === false) {
             $request->getSession()->getFlashBag()->add('danger','Veuillez Ajouter un ticket avant de valider le formulaire.');
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
