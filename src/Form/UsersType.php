<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 31/07/2018
 * Time: 13:26
 */

namespace App\Form;

use App\Domain\DTO\UsersDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

/**
 * Class AccountsType
 * @package App\Form
 */
class UsersType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, array('attr' => array('placeholder' => 'Votre nom'),))
            ->add('firstname',TextType::class, array('attr' => array('placeholder' => 'Votre prénom'),))
            ->add('dateofbirth',DateType::class, array(
                'invalid_message' => 'Format de date incorrect',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => array('placeholder' => 'dd/mm/YYYY','class' => 'datepicker'),
                'format' => 'dd/MM/yyyy',
                'years' => range(date('Y')-100, date('Y')-18),))
            ->add('email', EmailType::class, array('attr' => array('placeholder' => 'Votre adresse email'),))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => UsersDTO::class,
            'empty_data' => function(FormInterface $form){
                return new UsersDTO(
                    $form->get('name')->getData(),
                    $form->get('firstname')->getData(),
                    $form->get('dateofbirth')->getData(),
                    $form->get('email')->getData()
                    );
            }
        ));
    }
}
