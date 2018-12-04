<?php
/**
 * Created by PhpStorm.
 * User: Matthieu
 * Date: 04/12/2018
 * Time: 21:29
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AccountsControllerTest extends WebTestCase
{

    public function testaccountsInfo()
    {
        $client = static::createClient();

        $client->request('GET', '/accounts');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}