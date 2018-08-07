<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 31/07/2018
 * Time: 13:26
 */

namespace App\Form;

use App\DTO\usersParams;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;


class AccountsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, array('attr' => array('placeholder' => 'Votre nom'),))
            ->add('firstname',TextType::class, array('attr' => array('placeholder' => 'Votre prénom'),))
            ->add('dateofbirth',DateType::class, array(
                'invalid_message' => 'Format de date incorrect',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => array('class' => 'datepicker','placeholder' => 'dd/mm/YYYY'),
                'format' => 'dd/mm/yyyy',))
            ->add('email', EmailType::class, array('attr' => array('placeholder' => 'Votre adresse email'),))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => usersParams::class,
        ));
    }
}