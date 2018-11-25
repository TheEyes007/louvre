<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 04/10/2018
 * Time: 13:28
 */

namespace Tests\Form;

use App\Form\TicketsType;
use App\Domain\DTO\TicketsDTO;
use Symfony\Component\Form\Test\TypeTestCase;

class TicketsTypeTest extends TypeTestCase
{
    public function testsubmitForm()
    {
        $formData = [
            'name' => 'Acclassato',
            'firstname' => 'Florence',
            'dateofbirth' => '19/09/1979',
            'tarif' => 'Tarif Normal',
            'dateofbooking' => '10/10/2018',
            'country' => 'France'
        ];

        $objectToCompare = new TicketsDTO();
        // $objectToCompare will retrieve data from the form submission; pass it as the second argument
        $form = $this->factory->create(TicketsType::class, $objectToCompare);

        $object = new TicketsDTO();
        // ...populate $object properties with the data stored in $formData

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        // check that $objectToCompare was modified as expected when the form was submitted
        $this->assertEquals($object, $objectToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
