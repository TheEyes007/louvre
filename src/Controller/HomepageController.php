<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 30/07/2018
 * Time: 18:45
 */

namespace App\Controller;

use App\Controller\Interfaces\HomepageInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * Class HomepageController
 * @package App\Controller
 */
class HomepageController implements HomepageInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * HomepageController constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Matches / exactly
     *
     * @Route("/", methods="GET", name="homepage")
     */
    public function index()
    {
        return new Response($this->twig->render('site/index.html.twig'));
    }
}
