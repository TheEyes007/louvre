<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 06/09/2018
 * Time: 13:50
 */

namespace Tests\Service;

use App\Service\CheckAge;
use PHPUnit\Framework\TestCase;

/**
 * Class CheckAgeTest
 * @package Tests\Service
 */
class CheckAgeTest extends TestCase
{

    /**
     * Compare value
     */
    public function testGetAge()
    {
        $dateofbirth = '02/01/1983';
        $age = new CheckAge($dateofbirth);
        $age = $age->getAge();
        $this->assertSame(35, $age);
    }
}
