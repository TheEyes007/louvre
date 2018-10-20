<?php
/**
 * Created by PhpStorm.
 * User: Matthieu
 * Date: 19/10/2018
 * Time: 13:37
 */

namespace App\Service\Interfaces;

/**
 * Interface SendMailerInterface
 * @package App\Service\Interfaces
 */
interface SendMailerInterface
{

    /**
     * @return mixed
     */
    public function SendMail();
}
