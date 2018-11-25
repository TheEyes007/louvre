<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 20/11/2018
 * Time: 13:18
 */

namespace App\Controller;
use App\Controller\Interfaces\CGVInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * Class accountsController
 * @package App\Controller
 */
class CGVController implements CGVInterface
{

    /**
     * @var Environment
     */
    private $twig;

    public function __construct(
        Environment $twig
    )
    {
        $this->twig = $twig;
    }

    /**
     * Matches /cgv exactly
     *
     * @Route("/cgv", methods="GET", name="cgv")
     * @return Response
     */
    public function cgvCommand()
    {
        return new Response($this->twig->render('site/cgv.html.twig'));
    }
}
