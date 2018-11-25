<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 02/10/2018
 * Time: 13:29
 */

namespace App\Controller\Interfaces;

use Twig\Environment;

interface CGVInterface
{
    /**
     * @param $twig
     * @return mixed
     */
    public function __construct(
        Environment $twig
    );

    /**
     * @param $request
     * @return mixed
     */
    public function cgvCommand();
}
