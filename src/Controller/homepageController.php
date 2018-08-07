<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 30/07/2018
 * Time: 18:45
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class homepageController
{

    private $twig;

    public function __construct(Environment $twig){
        $this->twig = $twig;
    }

    public function index(){
        return new Response($this->twig->render('site/index.html.twig'));
    }
}