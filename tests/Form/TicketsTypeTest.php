<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 04/10/2018
 * Time: 13:28
 */
/**
namespace Tests\Service;

use App\Form\TicketsType;
use App\Domain\DTO\TicketsDTO;
use Symfony\Component\Form\Test\TypeTestCase;

class TicketsTypeTest extends TypeTestCase
{
    public function submitFormTest()
    {
        $formData = [
            'name' => 'Acclassato',
            'firstname' => 'Florence',
            'dateofbirth' => '19/09/1979',
            'tarif' => 'Tarif Normal',
            'dateofbooking' => '10/10/2018',
            'country' => 'France'
        ];

        $DTOModel = new TicketsDTO();
        $form = $this->factory->create(TicketsType::class, $DTOModel);

        $objectTest = new TicketsDTO();

        $form->submit($formData);
        $this->assertTrue($form->isSynchronized());
        $this->assertInstanceOf(TicketsDTO::class, $form->getData());
    }
}
 **/