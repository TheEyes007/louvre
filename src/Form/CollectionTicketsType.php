<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 31/07/2018
 * Time: 13:26
 */

namespace App\Form;

use App\Domain\DTO\CollectionTicketsDTO;
use App\Domain\DTO\UsersDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

/**
 * Class CollectionTicketsType
 * @package App\Form
 */
class CollectionTicketsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tickets', CollectionType::class, array(
                'entry_type' => TicketsType::class,
                'label' => false,
                'allow_add' => true,
                'allow_delete' => true,
        ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => UsersDTO::class,
        ));
    }
}
