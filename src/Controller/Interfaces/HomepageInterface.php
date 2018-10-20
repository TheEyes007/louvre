<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 04/09/2018
 * Time: 13:07
 */

namespace App\Controller\Interfaces;

use Twig\Environment;

interface HomepageInterface
{
    /**
     * @param $twig
     * @return mixed
     */
    public function __construct(Environment $twig);

    /**
     * @return mixed
     */
    public function index();
}
